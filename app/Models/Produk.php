<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    //
    public function kategori() {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    public function toko() {
        return $this->belongsTo(Toko::class, 'toko_id');
    }

    public function gambar() {
        return $this->hasMany(Gambar::class, 'id_produk', 'id_produk');
    }
}
