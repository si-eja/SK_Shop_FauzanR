<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class TokoController extends Controller
{
    //
    public function tkUpdate(Request $request, $id)
    {
        $id = $this->decryptId($id);

        $validate = $request->validate([
            'gambar' => 'image|nullable',
            'nama_toko' => 'required|string',
            'alamat' => 'required|string',
            'deskripsi' => 'required|string',
        ]);

        $toko = Toko::findOrFail($id);

        $fileName = $toko->gambar;
        
        if($request->hasFile('gambar')){
            $gambar = $request->file('gambar');
            $fileName = time().".".$gambar->getClientOriginalExtension();
            $gambar->storeAs('public/toko-img/', $fileName);

            $request['gambar'] = $fileName;
        }
        $toko->update([
            'gambar' => $fileName,
            'nama_toko' => $request->nama_toko,
            'alamat' => $request->alamat,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->back()->with('success', 'Toko di edit');
    }
    public function updateNomor(Request $request, $id){
        $id = $this->decryptId($id);
        $validate = $request->validate([
            'nomor' => 'string|unique:tokos,nomor|min:11|max:14|regex:/^[0-9]+$/'
        ],[
            'nomor.required' => 'Nomor kontak wajib diisi.',
            'nomor.unique' => 'Nomor kontak sudah terdaftar.',
            'nomor.min' => 'Nomor minimal 11 digit.',
            'nomor.max' => 'Nomor maksimal 14 digit.',
            'nomor.regex' => 'Nomor hanya boleh berisi angka.',
        ]);
        $nomor = $request->nomor;
        $nomor = str_replace(' ', '', $nomor); //menghilangkan spasi
        $nomor = ltrim($nomor, '+'); //manghapus +jika user melakukan input +62
        if (strpos($nomor, '62') === 0) {
            $nomor = $nomor;
        }
        else if (strpos($nomor, '0') === 0) {
            $nomor = '62' . substr($nomor, 1);
        }
        else {
            $nomor = '62' . $nomor;
        }
        $toko = Toko::findOrFail($id);
        $toko->update([
            'nomor' => $nomor
        ]);

        return redirect()->back()->with('success','Ubah nomor selesai');
    }
    public function changeStatus($id)
    {
        $toko = Toko::findOrFail($id);

        $toko->status = $toko->status === 'aktif' ? 'nonaktif' : 'aktif';
        $toko->save();
        return back()->with('success', 'Status toko berhasil diubah.');
    }
    private function decryptId($id){
        try{
            return Crypt::decrypt($id);
        }catch(DecryptException $e){
            abort(404);
        }
    }
}
