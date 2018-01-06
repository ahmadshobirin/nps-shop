<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'm_produk';

    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(KategoriProduk::class,'kategori_id');
    }
}
