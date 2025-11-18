<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    //
    protected $fillable = [
        'nama_produk',
        'deskripsi',
        'harga',
        'stok',
        'kategori_id',
        'toko_id'
    ];
    public function kategori() {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function toko() {
        return $this->belongsTo(Toko::class, 'toko_id');
    }

    public function gambar() {
        return $this->hasMany(Gambar::class, 'produk_id');
    }
}
