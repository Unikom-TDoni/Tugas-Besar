<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cabang extends Model
{
    // use HasFactory;
    public $timestamps      = false;
    protected $table        = 'cabang';
    protected $primaryKey   = 'id_cabang';

    protected $fillable = [
        'nama_cabang', 'telp', 'id_provinsi', 'id_kota', 'alamat'
    ];

    public function kendaraan() 
    {
        return $this->hasMany(Kendaraan::class);
    }

    public function getListData() 
    {
        $query = DB::table('cabang')
                    ->leftJoin('provinsi', 'cabang.id_provinsi', '=', 'provinsi.id')
                    ->leftJoin('kota', 'cabang.id_kota', '=', 'kota.id')
                    ->select('cabang.*', 'provinsi.nama as provinsi', 'kota.nama as kota')
                    ->orderBy('nama_cabang', 'asc');

        return $query;
    }

    public function getDetailData($id_cabang) 
    {
        $query = DB::table('cabang')->where("id_cabang", $id_cabang);

        return $query;
    }

    public function getListDataProvinsi() 
    {
        $query = DB::table('provinsi')->orderBy('nama', 'asc');

        return $query;
    }

    public function getListDataKotaByProvinsi($id_provinsi) 
    {
        $query = DB::table('kota')->where("id_provinsi", $id_provinsi)->orderBy('nama', 'asc');

        return $query;
    }

    public function updateAktivasi($id_cabang) 
    {
        $query = $this->getDetailData($id_cabang)->update(["is_aktif" => DB::raw("IF(is_aktif=1,0,1)")]);

        return $query;
    }
}
