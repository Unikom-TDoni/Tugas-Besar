<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kendaraan extends Model
{
    // use HasFactory;
    public $timestamps      = false;
    protected $table        = 'kendaraan';
    protected $primaryKey   = 'id_kendaraan';

    protected $fillable = [
        'nama_kendaraan', 
        'id_cabang', 
        'merk', 
        'jenis', 
        'harga_sewa', 
        'denda', 
        'jumlah_kendaraan', 
        'jumlah_terpakai', 
        'gambar'
    ];

    public function cabang() 
    {
        return $this->belongsTo(Cabang::class, 'id_cabang');
    }

    public function getNextId() 
    {
        $statement = DB::select("show table status like 'kendaraan'");

        return $statement[0]->Auto_increment;
    }

    public function getListData() 
    {
        $query = DB::table('kendaraan')
                    ->leftJoin('cabang', 'kendaraan.id_cabang', '=', 'cabang.id_cabang')
                    ->select('kendaraan.*', 'cabang.nama_cabang as cabang', DB::raw('jumlah_kendaraan - jumlah_terpakai as jumlah_tersedia'))
                    ->orderBy('nama_kendaraan', 'asc');
        
        return $query;
    }

    public function getDetailData($id_kendaraan) 
    {
        $query = DB::table('kendaraan')->where("id_kendaraan", $id_kendaraan);

        return $query;
    }

    public function updateKendaraanTerpakai($id_kendaraan, $operasi) 
    {
        $query = $this->getDetailData($id_kendaraan)->update(["jumlah_terpakai" => DB::raw("jumlah_terpakai ".$operasi." 1")]);

        return $query;
    }
}
