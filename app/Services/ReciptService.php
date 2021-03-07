<?php

namespace App\Services;

use App\Repositories\KotaRepository;
use App\Repositories\CabangRepository;
use App\Repositories\ProvinsiRepository;
use App\Repositories\TransaksiRepository;
use App\Repositories\KendaraanRepository;
use App\Repositories\PelangganRepository;
use App\Repositories\ReviewRepository;

final class ReciptService 
{
    private $kotaRepository;
    private $cabangRepository;
    private $reviewRepository;
    private $provinsiRepository;
    private $transaksiRepository;
    private $kendaraanRepository;
    private $pelanggganRepository;

    public function __construct(KotaRepository $kotaRepository,
        ReviewRepository $reviewRepository,    
        CabangRepository $cabangReposiotry,
        ProvinsiRepository $provinsiRepository,
        TransaksiRepository $transaksiRepository, 
        KendaraanRepository $kendaraanRepository,
        PelangganRepository $pelangganRepository)
    {
        $this->kotaRepository = $kotaRepository;
        $this->reviewRepository = $reviewRepository;
        $this->cabangRepository = $cabangReposiotry;
        $this->provinsiRepository = $provinsiRepository;
        $this->transaksiRepository = $transaksiRepository;
        $this->kendaraanRepository = $kendaraanRepository;
        $this->pelanggganRepository = $pelangganRepository;
    }

    /**
     * Get list info recipt
     * 
     * @param PrimaryKey @idPelanggan
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getListInfo($idPelanggan) 
    {
        $kota = $this->kotaRepository->getTableName();
        $review = $this->reviewRepository->getTableName();
        $cabang = $this->cabangRepository->getTableName();
        $provinsi = $this->provinsiRepository->getTableName();
        $kendaraan = $this->kendaraanRepository->getTableName();
        $pelanggan = $this->pelanggganRepository->getTableName();
        $relation = array(
            $review => function($query) { $this->reviewRepository->selectTransaksiRelation($query); },
            $pelanggan => function($query) {$this->pelanggganRepository->selectTransaksiRelation($query); },
            $kendaraan => function($query) { $this->kendaraanRepository->selectOutlineInfoTransaksiRelation($query); }, 
            $kendaraan.'.'.$cabang => function($query) { $this->cabangRepository->selectDetailInfoKendaraanRelation($query); },
            $kendaraan.'.'.$cabang.'.'.$kota => function ($query) { $this->kotaRepository->selectCabangRelation($query); },
            $kendaraan.'.'.$cabang.'.'.$kota.'.'.$provinsi => function($query) { $this->provinsiRepository->selectKotaRelation($query); }
        );
        
        $outlineInfo = $this->transaksiRepository->getListInfoRecipt($idPelanggan, $relation);
        foreach($outlineInfo as $item) {
            $item = $this->generateRecipteStatus($item);
            $item = $this->generateDifferenceOfDay($item);
        }

        return $outlineInfo;
    }
    

    /**
     * Generate difference of day
     * 
     * @param \Illuminate\Database\Eloquent\Model $modelTransaksi
     * @return \Illuminate\Database\Eloquent\Model
     */
    private function generateDifferenceOfDay($modelTransaksi)
    {
        $startDate = date_create($modelTransaksi->tanggal_mulai_peminjaman);
        $endDate = date_create($modelTransaksi->tanggal_akhir_peminjaman);
        $diffDay = date_diff($startDate, $endDate);
        $modelTransaksi->setAttribute('difference_of_day', $diffDay->format("%a"));
        return $modelTransaksi;
    }

    /**
     * Generate recipt status
     * 
     * @param \Illuminate\Database\Eloquent\Model $modelTransaksi
     * @return \Illuminate\Database\Eloquent\Model
     */
    private function generateRecipteStatus($modelTransaksi)
    {
        $status = $this->translateStatusTransaksi($modelTransaksi->status_transaksi);

        if($status[0] == "Dalam Proses") {
            $status = $this->translateStatusBayar($modelTransaksi->status_pembayaran, $modelTransaksi->is_transfer);
            if($status[0] == "Pembayaran Terkonfirmasi") 
                $status = $this->translateStatusPengembalian($modelTransaksi->status_pengembalian, $modelTransaksi->is_diantar);
        }

        $modelTransaksi->makeHidden(['status_transaksi', 'status_pembayaran', 'status_pengembalian', 'is_transfer', 'is_diantar']); 
        $modelTransaksi->setAttribute('status_recipt', $status);

        return $modelTransaksi;
    }

     /**
     * Translate status transaksi into string
     * 
     * @param int $statusTransaksi
     * @return string
     */
    private function translateStatusTransaksi($statusTransaksi) 
    {
        switch($statusTransaksi)
        {
            case 0:
               return ['Dalam Proses', 'info'];
            case 1:
                return ['Selesai', 'success'];
            case 2:
                return ['Dibatalkan', 'error'];
        }
    }

    /**
     * Translate status bayar into string
     * 
     * @param int $statusBayar
     * @param boolean $isTransfer
     * @return string
     */
    private function translateStatusBayar($statusBayar, $isTransfer)
    {
        switch($statusBayar)
        {
            case 0:
                return $isTransfer == 0 ? ["Menunggu Pembayaran di Tempat", 'warning'] : ["Menunggu Transfer", 'warning'];
            case 1:
                return ["Menunggu Konfirmasi Pembayaran", 'warning'];
            case 2:
                return ["Pembayaran Terkonfirmasi", 'success'];
        }
    }

    /**
     * Translate status pengembalian into string
     * 
     * @param int $statusPengembalian
     * @param boolean $isDiantar
     * @return string
     */
    private function translateStatusPengembalian($statusPengembalian, $isDiantar)
    {
        switch($statusPengembalian) 
        {
            case 0:
                return $isDiantar == 0 ? ["Menunggu Diambil", 'info'] : ["Menunggu Diantar", 'info'];
            case 1:
                return ["Menunggu Pengembalian", 'info'];
            case 2:
                return ["Sudah Dikembalikan", 'success'];
        }
    }
}