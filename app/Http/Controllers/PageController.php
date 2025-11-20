<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Toko;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    //
    public function index()
    {
        $data['toko'] = Toko::with('user')->where(function($q){
            $q->where('nama_toko','!=','-')
                ->where('alamat','!=','-')
                ->take(3)->get();
        })->get();
        $data['produk'] = Produk::latest()->where('nama_produk', '!=', '-')
            ->where('stok', '!=', 0)
            ->take(8)
            ->get();
        $data['kategori'] = Kategori::all();
        $data['prodkat'] = Produk::with('gambar', 'kategori')
            ->where('stok', '!=', 0)
            ->get();
        return view('home', $data);
    }
    public function admin()
    {
        return view('admin.dash');
    }
    public function kategori()
    {
        $data['kategori'] = Kategori::all();
        return view('admin.kategori', $data);
    }
    public function login(){
        return view('login');
    }
    public function regis(){
        return view('regis');
    }
    //Akses toko member
    public function tokoM(Request $request, string $id)
    {
        $tokoId = Crypt::decrypt($id);
        $data['toko'] = Toko::findOrFail($tokoId);
        $data['isNonaktif'] = $data['toko']->status === 'nonaktif';
        $data['produk'] = $data['toko']->produk()->get();
        $data['kategori'] = Kategori::all();
        return view('member.toko', $data);
    }
    public function tokoA(){
        $data['tokos'] = Toko::all();
        return view('admin.toko', $data);
    }
    public function back(){
        return redirect()->back();
    }
    private function decryptId($id){
        try{
            return Crypt::decrypt($id);
        }catch(DecryptException $e){
            abort(404);
        }
    }
    public function ktoko(string $id){
        $id = $this->decryptId($id);

        $data['toko'] = Toko::findOrFail($id);
        $data['tokos'] = Toko::where('id', '!=', $id)->limit(4)->get();
        $data['tokok'] = Toko::with('produk.kategori')->findOrFail($id);
        $data['katToko'] = Kategori::whereIn('id', $data['toko']->produk->pluck('kategori_id')->unique())->get();
        return view('ktoko', $data);
    }
}
