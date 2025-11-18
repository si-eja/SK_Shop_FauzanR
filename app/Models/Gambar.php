<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gambar extends Model
{
    //
    protected $fillable = [
        'produk_id',
        'nama_gambar'
    ];
    public function produk() {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}
