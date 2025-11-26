<?php

namespace App\Http\Controllers;

use App\Models\Gambar;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    //
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'kategori_id' => 'required',
            'deskripsi' => 'required|string',
            'gambar_produk' => 'required',
            'gambar_produk.*' => 'nullable|image|mimes:jpg,jpeg,webp,png|max:2048',
        ]);
        $produk = Produk::create([
            'nama_produk' => $validated['nama_produk'],
            'deskripsi' => $validated['deskripsi'],
            'harga' => $validated['harga'],
            'stok' => 0,
            'kategori_id' => $validated['kategori_id'],
            'toko_id' => auth()->user()->toko->id,
        ]);
        if ($request->hasFile('gambar_produk')) {
            foreach ($request->file('gambar_produk') as $file) {
                $filename = time().'-'.uniqid(). '.'.$file->getClientOriginalExtension();
                $file->storeAs('public/img-prod/', $filename);

                // Simpan ke table gambar_produks
                Gambar::create([
                    'produk_id' => $produk->id,
                    'nama_gambar' => $filename
                ]);
            }
        }
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan.');
    }
    public function updateStock(Request $request, $id)
    {
        $id = $this->decryptId($id);

        Produk::where('id', $id)->update([
            'stok' => $request->stok,
        ]);

        return redirect()->back()->with('success', 'Stok produk berhasil diperbarui.');
    }
    public function update(Request $request,string $id)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required',
            'kategori_id' => 'required',
            'deskripsi' => 'required|string',
            'gambar_produk' => 'required',
            'gambar_produk.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $produk = Produk::findOrFail($id);

        $produk->update([
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'kategori_id' => $request->kategori_id,
            'deskripsi' => $request->deskripsi
        ]);

        foreach ($produk->gambar as $g) {
            if (Storage::disk('public')->exists('public/img-prod/'.$g->nama_gambar)) {
                Storage::disk('public')->delete('public/img-prod/'.$g->nama_gambar);
            }
            $g->delete();
        }
        // Upload gambar baru jika ada
        if ($request->hasFile('gambar_produk')) {
            foreach ($request->file('gambar_produk') as $file) {
                $filename = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/img-prod/', $filename);
                
                Gambar::create([
                    'produk_id' => $produk->id,
                    'nama_gambar' => $filename
                ]);
            }
        }
        return redirect()->back()->with('success', 'Produk berhasil diperbarui.');
    }
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        // Hapus gambar di storage
        foreach ($produk->gambar as $gbr) {
            Storage::delete('public/img-prod/' . $gbr->nama_gambar);
            $gbr->delete();
        }
        // Hapus produk
        $produk->delete();
        return redirect()->back()->with('success', 'Produk berhasil dihapus.');
    }
    public function kirimWA($id)
    {
        // Ambil produk + relasi ke toko + kategori
        $produk = Produk::with(['toko', 'kategori'])->findOrFail($id);

        // Ambil nomor dari tabel toko
        $nomor = $produk->toko->nomor;  // 👈 otomatis ambil nomor WA toko

        // Format pesan
        $pesan = "
    Halo, saya ingin memesan produk:

    Nama: {$produk->nama_produk}
    Harga: Rp " . number_format($produk->harga, 0, ',', '.') . "
    Kategori: {$produk->kategori->nama_kategori}
    Deskripsi:
    {$produk->deskripsi}

    Apakah stok masih ada?
        ";

        $pesan = urlencode($pesan);

        // Buat URL WhatsApp
        $waUrl = "https://wa.me/{$nomor}?text={$pesan}";

        return redirect()->away($waUrl);
    }
    private function decryptId($id){
        try{
            return Crypt::decrypt($id);
        }catch(DecryptException $e){
            abort(404);
        }
    }
}
