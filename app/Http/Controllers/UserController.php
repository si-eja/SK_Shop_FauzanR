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
            'name' => 'required|string',
            'username' => 'required|string|unique:users,username',
            'password' => 'required',
            'nomor' => 'required|string|unique:tokos,nomor|min:11|max:14|regex:/^[0-9]+$/',
        ],[
            'name.required' => 'Nama wajib diisi.',
            'username.required' => 'Nama pengguna wajib diisi.',
            'username.unique' => 'Nama pengguna sudah digunakan.',
            'password.required' => 'Password wajib diisi.',
            'nomor.required' => 'Nomor kontak wajib diisi.',
            'nomor.unique' => 'Nomor kontak sudah terdaftar.',
            'nomor.min' => 'Nomor minimal 11 digit.',
            'nomor.max' => 'Nomor maksimal 14 digit.',
            'nomor.regex' => 'Nomor hanya boleh berisi angka.',
        ]);
        // ====== SANITASI NOMOR → WAJIB DITARUH DI SINI ======
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
        
        $user = User::Create([
            'name' => $request->name,
            'username' => $request->username,
            'level' => 'member',
            'password' => bcrypt($request->password),
        ]);
        Toko::Create([
            'user_id' => $user->id,
            'nama_toko' => '-',
            'alamat' => '-',
            'deskripsi' => '-',
            'nomor' => $nomor,
            'gambar' => '-',
        ]);
        return redirect()->route('login')->with('success', 'Register success');
    }
    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
