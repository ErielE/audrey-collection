<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $guarded = [];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
