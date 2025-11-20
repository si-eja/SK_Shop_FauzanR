<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    //
    protected $fillable = [
        'nama_toko',
        'user_id',
        'status',
        'alamat',
        'deskripsi',
        'nomor',
        'gambar',
    ];
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function produk() {
        return $this->hasMany(Produk::class, 'toko_id');
    }
}
