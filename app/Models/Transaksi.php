<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Kendaraan;

class Transaksi extends Model
{
    public $timestamps  = false;
    protected $table    = 'transaksi';

    protected $fillable = [
        'kode_transaksi', 
        'tanggal_transaksi', 
        'telp', 
        'nama', 
        'nomor_ktp', 
        'alamat', 
        'id_kendaraan', 
        'nomor_plat', 
        'tanggal_mulai_peminjaman', 
        'tanggal_akhir_peminjaman', 
        'is_diantar', 
        'waktu_antar', 
        'alamat_antar', 
        'harga_sewa', 
        'denda', 
        'total_bayar'
    ];

    public function getListData($tgl_awal, $tgl_akhir, $filter) 
    {
        $query = DB::table('transaksi')
                    ->leftJoin('kendaraan', 'transaksi.id_kendaraan', '=', 'kendaraan.id_kendaraan')
                    ->select('transaksi.*', 'kendaraan.nama_kendaraan as kendaraan')
                    ->whereBetween('tanggal_transaksi', [$tgl_awal, $tgl_akhir]);

        if($filter==1)
        {
            // TRANSAKSI DIPROSES
            $query = $query->where('status_pengembalian', 0);
        }
        elseif($filter==2)
        {
            // TRANSAKSI BERHASIL
            $query = $query->where('status_pengembalian', 1);
        }
        elseif($filter==3)
        {
            // TRANSAKSI BATAL
            $query = $query->where('status_transaksi', 2);
        }

        $query = $query->orderBy('tanggal_transaksi', 'desc');
        
        return $query;
    }

    public function getDetailData($kode_transaksi) 
    {
        $query = DB::table('transaksi')
                    ->leftJoin('kendaraan', 'transaksi.id_kendaraan', '=', 'kendaraan.id_kendaraan')
                    ->select('transaksi.*', 'kendaraan.nama_kendaraan as kendaraan')
                    ->where("kode_transaksi", $kode_transaksi);

        return $query;
    }

    public function generateKodeTransaksi()
    {
        $data = DB::table('transaksi')->where("tanggal_transaksi", date("Y-m-d"))->orderBy('kode_transaksi', 'desc')->first();
        
        $tgl = date("ymd");
        if(isset($data->kode_transaksi))
        {
            $last_code      = $data->kode_transaksi;
            $lastIncreament = substr($last_code, -3);
            $kode_transaksi = 'T' . date('ymd') . str_pad($lastIncreament + 1, 3, 0, STR_PAD_LEFT);
        }
        else
        {
            $kode_transaksi = "T" . $tgl . "001";
        }

        return $kode_transaksi;
    }

    public function updateStatusTransaksi($kode_transaksi, $status, $value)
    {
        $classKendaraan = new Kendaraan();

        $query  = $this->getDetailData($kode_transaksi);
        $data   = $query->first();
        
        if($status == "nomor_plat")
        {
            // Update Kendaraan Terpakai
            $update = $classKendaraan->updateKendaraanTerpakai($data->id_kendaraan, "+");

            $query = $query->update(["nomor_plat" => $value, "status_transaksi" => 1]);
        }
        elseif($status == "transaksi")
        {
            if($data->status_transaksi == 1)
            {
                // Update Kendaraan Terpakai
                $update = $classKendaraan->updateKendaraanTerpakai($data->id_kendaraan, "-");
            }

            $query = $query->update(["status_transaksi" => $value]);
        }
        elseif($status == "pembayaran")
        {
            $query = $query->update(["status_pembayaran" => $value]);
        }
        elseif($status == "pengembalian")
        {
            // Update Kendaraan Terpakai
            $update = $classKendaraan->updateKendaraanTerpakai($data->id_kendaraan, "-");

            $query = $query->update(["status_pengembalian" => $value, "waktu_pengembalian" => NOW()]);
        }
        elseif($status == "denda")
        {
            $total_bayar = $data->total_bayar + $value;
            $query = $query->update(["transaksi.denda" => $value, "total_bayar" => $total_bayar]);
        }

        return $query;
    }
}
