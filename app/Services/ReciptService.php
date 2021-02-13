<?php

namespace App\Services;

use App\Repositories\KotaRepository;
use App\Repositories\CabangRepository;
use App\Repositories\TransaksiRepository;
use App\Repositories\PelangganRepository;
use App\Repositories\KendaraanRepository;

final class ReciptService 
{
    private $kotaRepository;
    private $cabangRepository;
    private $transaksiRepository;
    private $pelangganRepository;
    private $kendaraanRepository;

    public function __construct(TransaksiRepository $transaksiRepository, 
        PelangganRepository $pelangganRepository, 
        KendaraanRepository $kendaraanRepository,
        CabangRepository $cabangReposiotry,
        KotaRepository $kotaRepository)
    {
        $this->kotaRepository = $kotaRepository;
        $this->cabangRepository = $cabangReposiotry;
        $this->transaksiRepository = $transaksiRepository;
        $this->pelangganRepository = $pelangganRepository;
        $this->kendaraanRepository = $kendaraanRepository;
    }

    /**
     * Get outline info recipt
     * 
     * @param PrimaryKey @idPelanggan
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getOutlineInfo($idPelanggan) 
    {
        $cabang = $this->cabangRepository->getTableName();
        $kendaraan = $this->kendaraanRepository->getTableName();
        $relation = array(
            $kendaraan => function($query) { $this->kendaraanRepository->selectOutlineInfoTransaksiRelation($query); }, 
            $kendaraan.'.'.$cabang => function($query) { $this->cabangRepository->selectOutlineInfoKendaraanRelation($query); }
        );
        
        $outlineInfo = $this->transaksiRepository->getOutlineInfoRecipt($idPelanggan, $relation);
        foreach($outlineInfo as $item) 
            $item = $this->generateRecipteStatus($item);

        return $outlineInfo;
    }
    
    /**
     * Get detail info recipt
     * 
     * @param PrimaryeKey $kodeTransaski
     * @param PrimaryKey $idPelanggan
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getDetailInfo($kodeTransaski, $idPelanggan)
    {
        $kota = $this->kotaRepository->getTableName();
        $cabang = $this->cabangRepository->getTableName();
        $kendaraan = $this->kendaraanRepository->getTableName();
        $pelanggan = $this->pelangganRepository->getTableName();
        $relation = array(
            $pelanggan => function($query) { $this->pelangganRepository->selectTransaksiRelation($query); },
            $kendaraan => function($query) { $this->kendaraanRepository->selectDetailInfoTransaksiRelation($query); },
            $kendaraan.'.'.$cabang => function($query) { $this->cabangRepository->selectDetailInfoKendaraanRelation($query); },
            $kendaraan.'.'.$cabang.'.'.$kota => function ($query) { $this->kotaRepository->selectCabangRelation($query); }
        );

        $detailInfo = $this->transaksiRepository->getDetailInfoRecipt($kodeTransaski, $relation);
        $detailInfoWithRecipt = $this->generateRecipteStatus($detailInfo);
        
        return $detailInfo->id_pelanggan == $idPelanggan ? $detailInfoWithRecipt : abort(404);
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

        if($status == "Transaksi Dalam Proses") {
            $status = $this->translateStatusBayar($modelTransaksi->status_pembayaran, $modelTransaksi->is_transfer);
            if($status == "Pembayaran Terkonfirmasi") 
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
               return 'Transaksi Dalam Proses';
            case 1:
                return 'Transaksi Selesai';
            case 2:
                return 'Transaksi Dibatalkan';
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
                return $isTransfer == 0 ? "Menunggu Pembayaran" : "Menunggu Transfer";
            case 1:
                return "Menunggu Konfirmasi Pembayaran";
            case 2:
                return "Pembayaran Terkonfirmasi";
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
                return $isDiantar == 0 ? "Menunggu Diambil" : "Menunggu Diantar";
            case 1:
                return "Menunggu Pengembalian";
            case 2:
                return "Sudah Dikembalikan";
        }
    }
}