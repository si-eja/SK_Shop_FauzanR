<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gambar extends Model
{
    //
    public function produk() {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }
}
