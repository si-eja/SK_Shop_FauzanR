<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Toko;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    //
    public function index()
    {
        $data['toko'] = Toko::with('user')
            ->where('status', 'aktif')
            ->where('nama_toko','!=','-')
            ->where('alamat','!=','-')
            ->take(3)->get();
        $data['produk'] = Produk::latest()
            ->where('nama_produk', '!=', '-')
            ->where('stok', '!=', 0)
            ->whereHas('toko', function($q){
                $q->where('status', 'aktif'); // <--- Filter produk hanya dari toko aktif
            })->take(8)->get();
        $data['kategori'] = Kategori::all();
        $data['prodkat'] = Produk::with('gambar', 'kategori')
            ->where('stok', '!=', 0)
            ->whereHas('toko', function($q){
                $q->where('status', 'aktif'); // <--- Filter toko aktif lagi
            })->get();
        return view('home', $data);
    }
    public function allProd(){
        $data['produk'] = Produk::latest()
        ->where('nama_produk', '!=', '-')
        ->where('stok', '!=', 0)
        ->whereHas('toko', function($q){
            $q->where('status', 'aktif');
        })->take(4)->get();
        $data['kategori'] = Kategori::all();
        $data['prodkat'] = Produk::with('gambar', 'kategori')
        ->where('stok', '!=', 0)
        ->whereHas('toko', function($q){
            $q->where('status', 'aktif');
        })->get();
        $data['aProduk'] = Produk::where('nama_produk', '!=', '-')
        ->where('stok', '!=', 0)
        ->whereHas('toko', function($q){
            $q->where('status', 'aktif');
        })->get();
        return view('allprod', $data);
    }
    public function allToko(){
        $data['toko'] = Toko::with('user')
        ->where('status', 'aktif')
        ->where('nama_toko','!=','-')
        ->where('alamat','!=','-')
        ->take(3)->get();
        $data['aToko'] = Toko::latest()->with('user')
        ->where('status', 'aktif')
        ->where('nama_toko','!=','-')
        ->where('alamat','!=','-')
        ->get();
        return view('alltoko', $data);
    }
    public function search(Request $request)
    {
        $key = $request->q;
        // Cari produk berdasarkan nama / kategori / harga / deskripsi
        $produk = Produk::with('gambar', 'kategori', 'toko')
            ->whereHas('toko', function($t){
                $t->where('status', 'aktif'); // toko nonaktif tidak muncul
            })
            ->where(function ($x) use ($key) {
                $x->where('nama_produk', 'like', "%$key%")
                ->orWhere('deskripsi', 'like', "%$key%");
            })
            ->get();

        return view('cari', compact('produk','key'));
    }
    public function admin()
    {
        $data['user'] = User::where('level', 'member')->get();
        $data['produk'] = Produk::all();
        $data['toko'] = Toko::all();
        $data['kategori'] = Kategori::all();
        return view('admin.dash', $data);
    }
    public function kategori(){
        $data['kategori'] = Kategori::all();
        return view('admin.kategori', $data);
    }
    public function produkA(){
        $data['produk'] = Produk::all();
        return view('admin.produk',$data);
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
        // Ambil input pencarian dari form
        $keyword = $request->keyword;

        // Jika ada pencarian, filter produk berdasarkan keyword
        $data['produk'] = $data['toko']->produk()
        ->when($keyword, function ($query) use ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('nama_produk', 'LIKE', "%{$keyword}%")
                ->orWhere('harga', 'LIKE', "%{$keyword}%")
                ->orWhereHas('kategori', function ($q2) use ($keyword) {
                    $q2->where('nama_kategori', 'LIKE', "%{$keyword}%");
                });
            });
        })->get();
        $data['kategori'] = Kategori::all();
        $data['keyword'] = $keyword;
        return view('member.toko', $data);
    }
    public function tokoA(Request $request){
        $query = Toko::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;

            $query->where('nama_toko', 'like', "%$search%")
                ->orWhereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%");
                })
                ->orWhere('nomor', 'like', "%$search%");
        }
        $data['tokos'] = $query->get();
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
    public function dprod(string $id){
        $id = $this->decryptId($id);

        $data['produk'] = Produk::findOrFail($id);
        $data['produkL'] = Produk::with('kategori', 'gambar', 'toko')->findOrFail($id);

        // Produk lain yang memiliki kategori sama
        $data['katProduk'] = Produk::where('kategori_id', $data['produkL']->kategori_id)
                            ->where('id', '!=', $data['produkL']->id)
                            ->limit(8)
                            ->get();
        return view('detprod', $data);
    }
}
