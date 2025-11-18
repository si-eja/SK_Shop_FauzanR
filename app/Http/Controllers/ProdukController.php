<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class ProdukController extends Controller
{
    //
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required',
            'kategori_id' => 'required',
            'deskripsi' => 'required|string',
        ]);
        Produk::create([
            'nama_produk' => $validated['nama_produk'],
            'deskripsi' => $validated['deskripsi'],
            'harga' => $validated['harga'],
            'stok' => 0,
            'kategori_id' => $validated['kategori_id'],
            'toko_id' => auth()->user()->toko->id,
        ]);
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
    private function decryptId($id){
        try{
            return Crypt::decrypt($id);
        }catch(DecryptException $e){
            abort(404);
        }
    }
}
