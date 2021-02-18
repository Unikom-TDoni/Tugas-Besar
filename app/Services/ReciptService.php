<?php

namespace App\Services;

use App\Repositories\KotaRepository;
use App\Repositories\CabangRepository;
use App\Repositories\ProvinsiRepository;
use App\Repositories\TransaksiRepository;
use App\Repositories\KendaraanRepository;

final class ReciptService 
{
    private $kotaRepository;
    private $cabangRepository;
    private $provinsiRepository;
    private $transaksiRepository;
    private $kendaraanRepository;

    public function __construct(KotaRepository $kotaRepository,
        CabangRepository $cabangReposiotry,
        ProvinsiRepository $provinsiRepository,
        TransaksiRepository $transaksiRepository, 
        KendaraanRepository $kendaraanRepository)
    {
        $this->kotaRepository = $kotaRepository;
        $this->cabangRepository = $cabangReposiotry;
        $this->provinsiRepository = $provinsiRepository;
        $this->transaksiRepository = $transaksiRepository;
        $this->kendaraanRepository = $kendaraanRepository;
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
        $cabang = $this->cabangRepository->getTableName();
        $provinsi = $this->provinsiRepository->getTableName();
        $kendaraan = $this->kendaraanRepository->getTableName();
        $relation = array(
            $kendaraan => function($query) { $this->kendaraanRepository->selectOutlineInfoTransaksiRelation($query); }, 
            $kendaraan.'.'.$cabang => function($query) { $this->cabangRepository->selectDetailInfoKendaraanRelation($query); },
            $kendaraan.'.'.$cabang.'.'.$kota => function ($query) { $this->kotaRepository->selectCabangRelation($query); },
            $kendaraan.'.'.$cabang.'.'.$kota.'.'.$provinsi => function($query) { $this->provinsiRepository->selectKotaRelation($query); }
        );
        
        $outlineInfo = $this->transaksiRepository->getListInfoRecipt($idPelanggan, $relation);
        foreach($outlineInfo as $item) $item = $this->generateRecipteStatus($item);
        
        return $outlineInfo;
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

        if($status == "Dalam Proses") {
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
               return 'Dalam Proses';
            case 1:
                return 'Selesai';
            case 2:
                return 'Dibatalkan';
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