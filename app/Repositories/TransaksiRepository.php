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
    }

    /**
     * Get Detail Info Of Recipt
     * 
     * @param PrimaryKey @idPelanggan
     * @param array @relation
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getOutlineInfoRecipt($idPelanggan, array $relation) 
    {
        return $this->model
            ->with($relation)
            ->where('id_pelanggan', $idPelanggan)
            ->orderby('tanggal_transaksi')
            ->get([
                'kode_transaksi',
                'id_kendaraan',
                'is_transfer',
                'is_diantar',
                'waktu_antar',
                'status_transaksi', 
                'status_pembayaran', 
                'status_pengembalian',
                'tanggal_mulai_peminjaman', 
                'tanggal_akhir_peminjaman',
            ]);
    }

    /**
     * Get Detail Info Of Recipt
     * 
     * @param string $kodeTransaksi
     * @param array @relation
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getDetailInfoRecipt(string $kodeTranskasi, array $relation)
    {
        return $this->model
            ->with($relation)
            ->find($kodeTranskasi, [
                'kode_transaksi',
                'id_kendaraan',
                'id_pelanggan',
                'nomor_plat', 
                'is_transfer',
                'is_diantar',
                'total_bayar',
                'status_transaksi', 
                'status_pembayaran', 
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
        $validatedData['tanggal_transaksi'] = now();
        $validatedData['kode_transaksi'] = $this->model->generateKodeTransaksi();
        $validatedData['total_bayar'] = $this->calculateTotalHarga(
            $validatedData['tanggal_mulai_peminjaman'],
            $validatedData['tanggal_akhir_peminjaman'], 
            $validatedData['harga_sewa']
        );
        $this->model->create($validatedData);
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
        return (double)$hargaKendaraan * $ammountDayBorrow;
    }
}