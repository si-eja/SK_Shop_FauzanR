<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function authLogin(Request $request)
    {
        $validate= $request->validate([
            'username' => 'required|string',
            'password' => 'required'
        ]);

        if (Auth::attempt($validate)) {
            $user = Auth::user();
            if ($user->level == 'admin'){
                return redirect()->route('admin')->with('success','Login Success');
            }else if ($user->level == 'member'){
                return redirect()->route('home')->with('success','Login Success');
            }else{
                Auth::logout();
                return redirect()->route('login')->with('error','Please Login Again');
            }
        }
        return redirect()->back()->with('pesan','login failed');
    }
    public function regPost(Request $request){
        $validate = $request->validate([
            'nama' => 'required|string',
            'username' => 'required|string',
            'password' => 'required|unique:user,password',
            'kontak' => 'required|string',
        ]);
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'level' => 'member',
            'password' => bcrypt($request->password),
        ]);
        Toko::create([
            'user_id' => $user->id,
            'nama_toko' => '-',
            'alamat' => '-',
            'deskripsi' => '-',
            'nomor' => $request->kontak,
            'gambar' => '-',
        ]);
    }
}
