<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class PageController extends Controller
{
    //
    public function index()
    {
        $data['toko'] = Toko::with('user')->where(function($q){
            $q->where('nama_toko','!=','-')
                ->Where('gambar','!=','-')
                ->where('alamat','!=','-')
                ->take(3)->get();
        })->get();

        return view('home', $data);
    }
    public function admin()
    {
        return view('admin.dash');
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
        $data['produk'] = $data['toko']->produk()->get();
        return view('member.toko', $data);
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
}
