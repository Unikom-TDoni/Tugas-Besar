<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    protected $table = 'kota';

    public function cabang() 
    {
        return $this->hasMany(Cabang::class);
    }

    public function provinsi() 
    {
        return $this->belongsTo(Provinsi::class, 'id_provinsi');
    }
}