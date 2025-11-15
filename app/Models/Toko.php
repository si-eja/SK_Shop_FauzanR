<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    //
    protected $fillable = [
        'nama_toko',
        'user_id',
        'alamat',
        'deskripsi',
        'nomor',
        'gambar',
    ];
    public function user() {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function produk() {
        return $this->hasMany(Produk::class, 'id_toko', 'id_toko');
    }
}
