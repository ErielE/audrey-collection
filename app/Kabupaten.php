<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    public function kota()
    {
        return $this->belongsTo(Kota::class);
    }
}
