<?php   

namespace App\Repositories;

use DateTime;
use App\Models\Transaksi;
use App\Repositories\Base\BaseRepository;

final class TransaksiRepository extends BaseRepository
{
    public function __construct(Transaksi $model) 
    {
        parent::__construct($model);
        date_default_timezone_set('Asia/Jakarta');
    }

    /**
     * Get Detail Info Of Recipt
     * 
     * @param PrimaryKey @idPelanggan
     * @param array @relation
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getListInfoRecipt($idPelanggan, array $relation) 
    {
        return $this->model
            ->with($relation)
            ->where('id_pelanggan', $idPelanggan)
            ->orderBy('kode_transaksi', 'desc')
            ->get([
                'kode_transaksi',
                'id_pelanggan',
                'id_kendaraan',
                'is_transfer',
                'is_diantar',
                'waktu_antar',
                'alamat_antar',
                'total_bayar',
                'status_transaksi', 
                'status_pembayaran', 
                'tanggal_transaksi',
                'status_pengembalian',
                'tanggal_mulai_peminjaman', 
                'tanggal_akhir_peminjaman',
            ]);
    }

    /**
     * To create new data
     * 
     * @param array $validatedData
     */
    public function create(array $validatedData)
    {
        $validatedData['tanggal_transaksi'] = date("Y-m-d");;
        $validatedData['kode_transaksi'] = $this->model->generateKodeTransaksi();
        $validatedData['total_bayar'] = $this->calculateTotalHarga(
            $validatedData['tanggal_mulai_peminjaman'],
            $validatedData['tanggal_akhir_peminjaman'], 
            $validatedData['harga_sewa']
        );
        $this->model->create($validatedData);
    }

    /**
     * To update data
     * 
     * @param PrimaryKey $kodeTransaksi
     * @param array $validatedData
     */
    public function update($kodeTransaksi, array $validatedData) 
    {
        $this->model->findOrFail($kodeTransaksi)->update($validatedData);
    }

    /**
     * Get transaksi code
     * 
     * @param PrimaryKey $idPelanggan
     * @param PrimaryKey $idKendaraan
     * 
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getTransaksiCode($idPelanggan, $idKendaraan) 
    {
        return $this->model
            ->select('kode_transaksi', 'id_pelanggan', 'id_kendaraan')
            ->where(['id_pelanggan' => $idPelanggan, 'id_kendaraan' => $idKendaraan]);
    }

    /**
     * To Update status pembayaran
     * 
     * @param PrimaryKey $kodeTransaksi
     * @param int $value
     */
    public function updateStatusPembayaran($kodeTransaksi, $value)
    {
        $this->model->findOrFail($kodeTransaksi)->update(['status_pembayaran' => $value]);
    }

    /**
    * To Get Table Name
    * 
    * @return string
    */
    public function getTableName() 
    {
        return 'transaksi';
    }

    /**
     * Calculate Total Harga
     * 
     * @param string $tanggalAkhirPemesanan
     * @param string $tanggalAwalPemesanan
     * @param string $hargaKendaraan
     * @return double
     */
    private function calculateTotalHarga($tanggalAwalPemesanan, $tanggalAkhirPemesanan, $hargaKendaraan) 
    {
        $earlierDate  = new DateTime($tanggalAwalPemesanan);
        $laterDate = new DateTime($tanggalAkhirPemesanan);
        $ammountDayBorrow = $laterDate->diff($earlierDate)->format("%a");
        return (int)$hargaKendaraan * $ammountDayBorrow;
    }
}