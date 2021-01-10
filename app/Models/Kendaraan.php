<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Kendaraan extends Model
{
    // use HasFactory;
    public $timestamps      = false;
    protected $table        = 'kendaraan';
    protected $primaryKey   = 'id_kendaraan';

    protected $fillable = [
        'nama_kendaraan', 'id_cabang', 'merk', 'jenis', 'harga_sewa', 'denda', 'jumlah_kendaraan', 'jumlah_terpakai', 'gambar'
    ];

    public function getNextId() 
    {
        $statement = DB::select("show table status like 'kendaraan'");
        return $statement[0]->Auto_increment;
    }
}
