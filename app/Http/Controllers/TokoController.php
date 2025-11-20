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
