<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    public $timestamps = ["created_at"];
    protected $table    = 'ulasan';
    
    public function transaksi() 
    {
        return $this->belongsTo(Transaksi::class, 'kode_transaksi');
    }

    public function pelanggan() 
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }

    public function kendaraan() 
    {
        return $this->belongsTo(Pelanggan::class, 'id_kendaraan');
    }
    
    public function getListData($id_kendaraan) 
    {
        $query = DB::table('ulasan')->where('id_kendaraan', $id_kendaraan)->orderBy('created_at', 'desc');
        
        return $query;
    }

    public function getDataByKendaraan() 
    {
        $query = DB::table('ulasan')
                    ->selectRaw('id_kendaraan, COUNT(id) AS jumlah_ulasan, COUNT(IF(status=1,id,NULL)) AS jumlah_ulasan_ditampilkan, COUNT(IF(status=0,id,NULL)) AS jumlah_ulasan_tidak_ditampilkan')
                    ->groupBy('id_kendaraan');
        
        return $query;
    }

    public function getDetailData($id) 
    {
        $query = DB::table('ulasan')
                    ->leftJoin('kendaraan', 'ulasan.id_kendaraan', '=', 'kendaraan.id_kendaraan')
                    ->select('ulasan.*', 'kendaraan.nama_kendaraan as kendaraan')
                    ->where("id", $id);

        return $query;
    }

    public function updateStatus($id) 
    {
        $query = $this->getDetailData($id)->update(["status" => DB::raw("IF(status=1,0,1)")]);

        return $query;
    }
}
