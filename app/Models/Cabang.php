<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    // use HasFactory;
    public $timestamps      = false;
    protected $table        = 'cabang';
    protected $primaryKey   = 'id_cabang';

    protected $fillable = [
        'nama_cabang', 'provinsi', 'kota', 'alamat'
    ];

    public function kendaraan() 
    {
        return $this->hasMany(Kendaraan::class);
    }
}
