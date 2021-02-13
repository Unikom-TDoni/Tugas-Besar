<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Transaksi extends Model
{
    public $timestamps  = false;
    public $incrementing = false;
    
    protected $table    = 'transaksi';
    protected $primaryKey   = 'kode_transaksi';
    protected $keyType = 'string';
    
    protected $fillable = [
        'kode_transaksi', 
        'tanggal_transaksi', 
        'telp', 
        'nama', 
        'nomor_ktp', 
        'alamat', 
        'id_kendaraan', 
        'id_pelanggan', 
        'id_bank_account',
        'nomor_plat', 
        'tanggal_mulai_peminjaman', 
        'tanggal_akhir_peminjaman', 
        'is_transfer',
        'is_diantar', 
        'waktu_antar', 
        'alamat_antar', 
        'harga_sewa', 
        'denda', 
        'total_bayar',
        'status_pembayaran'
    ];

    public function pelanggan() 
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }

    public function kendaraan() 
    {
        return $this->belongsTo(Kendaraan::class, 'id_kendaraan');
    }

    public function bankAccount()
    {
        return $this->belongsTo(BankAccount::class, 'id_bank_account');
    }

    public function ulasan() 
    {
        return $this->hasMany(Ulasan::class);
    }

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
                    ->leftJoin('bank_account', 'transaksi.id_bank_account', '=', 'bank_account.id')
                    ->select('transaksi.*', 'kendaraan.nama_kendaraan as kendaraan', 'bank_account.*')
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
        
        if($status == "transaksi")
        {
            $query = $query->update(["status_transaksi" => $value]);
            
            if($value == 2)
            {
                $update = $classKendaraan->updateStatusTersedia($data->id_kendaraan); 
            }
        }
        elseif($status == "pembayaran")
        {
            $query = $query->update(["status_pembayaran" => $value]);
        }
        elseif($status == "pengembalian")
        {
            if($value == 2)
            {
                $update = $classKendaraan->updateStatusTersedia($data->id_kendaraan); 
                $query  = $query->update(["status_pengembalian" => $value, "waktu_pengembalian" => NOW(), "status_transaksi" => 1]);
            }
            else
            {
                $query = $query->update(["status_pengembalian" => $value]);
            }
        }
        elseif($status == "denda")
        {
            $total_bayar = $data->total_bayar + $value;
            $query = $query->update(["transaksi.denda" => $value, "total_bayar" => $total_bayar]);
        }

        return $query;
    }
}
