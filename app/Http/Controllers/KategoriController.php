<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class KategoriController extends Controller
{
    //
    public function index(Request $request)
    {
        $validate = $request->validate([
            'nama_kategori' =>'required|string',
        ]); 
        Kategori::create($validate);
        return redirect('/admin/kategori')->with('success', 'Kategori telah ditambahkan');
    }
    // untuk membuka modal edit
    public function edit($id)
    {
        $katEdit = Kategori::findOrFail($id);

        return response()->json([
            'id' => $katEdit->id,
            'nama_kategori' => $katEdit->nama_kategori
        ]);
    }
    public function update(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->save();

        return redirect()->route('kategori')->with('success', 'Kategori berhasil diupdate!');
    }
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return back()->with('success', 'Kategori berhasil dihapus!');
    }
    private function decryptId($id){
        try{
            return Crypt::decrypt($id);
        }catch(DecryptException $e){
            abort(404);
        }
    }
}
