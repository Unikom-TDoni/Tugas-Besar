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
        'warna',
        'tahun',
        'nomor_plat',
        'deskripsi',
        'harga_sewa', 
        'denda',
        'gambar',
        'is_aktif',
        'is_tersedia'
    ];

    public function cabang() 
    {
        return $this->belongsTo(Cabang::class, 'id_cabang');
    }

    public function transaksi() 
    {
        return $this->hasMany(Transaksi::class);
    }

    public function ulasan() 
    {
        return $this->hasMany(Ulasan::class);
    }

    public function getHargaSewaAttribute($value)
    {
        return number_format($value,0,'.','.');
    }

    public function getDendaAttribute($value)
    {
        return number_format($value,0,'.','.');
    }

    public function getNextId() 
    {
        $statement = DB::select("show table status like 'kendaraan'");

        return $statement[0]->Auto_increment;
    }

    public function getListData($filter_aktif = false) 
    {
        $query = DB::table('kendaraan')
                    ->leftJoin('cabang', 'kendaraan.id_cabang', '=', 'cabang.id_cabang')
                    ->select('kendaraan.*', 'cabang.nama_cabang as cabang')
                    ->orderBy('nama_kendaraan', 'asc');
        
        if($filter_aktif)
        {
            $query = $query->where([
                ['kendaraan.is_aktif', '=', '1'],
                ['kendaraan.is_tersedia', '=', '1'],
            ]);
        }

        return $query;
    }

    public function getDetailData($id_kendaraan) 
    {
        $query = DB::table('kendaraan')->where("id_kendaraan", $id_kendaraan);

        return $query;
    }

    public function updateAktivasi($id_kendaraan) 
    {
        $query = $this->getDetailData($id_kendaraan)->update(["is_aktif" => DB::raw("IF(is_aktif=1,0,1)")]);

        return $query;
    }

    public function updateStatusTersedia($id_kendaraan) 
    {
        $query = $this->getDetailData($id_kendaraan)->update(["is_tersedia" => DB::raw("IF(is_tersedia=1,0,1)")]);

        return $query;
    }
}
