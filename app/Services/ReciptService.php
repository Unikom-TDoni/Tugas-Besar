<?php

namespace App\Services;

use App\Repositories\TransaksiRepository;
use App\Repositories\PelangganRepository;
use App\Repositories\KendaraanRepository;

final class ReciptService 
{
    private $transaksiRepository;
    private $pelangganRepository;
    private $kendaraanRepository;

    public function __construct(TransaksiRepository $transaksiRepository, PelangganRepository $pelangganRepository, KendaraanRepository $kendaraanRepository)
    {
        $this->transaksiRepository = $transaksiRepository;
        $this->pelangganRepository = $pelangganRepository;
        $this->kendaraanRepository = $kendaraanRepository;
    }

    public function getOutlineInfo($idPelanggan) 
    {
        $kendaraan = $this->kendaraanRepository->getTableName();
        $relation = array(
            $kendaraan => function($query) { return $this->kendaraanRepository->selectOutlineInfoTransaksiRelationColumn($query);} 
        );
        
        $outlineInfo = $this->transaksiRepository->getOutlineInfoRecipt($idPelanggan, $relation);
        foreach($outlineInfo as $item) 
            $item = $this->generateRecipteStatus($item);

        return $outlineInfo;
    }
    
    public function getDetailInfo($kodeTransaski, $idPelanggan)
    {
        $kendaraan = $this->kendaraanRepository->getTableName();
        $pelanggan = $this->pelangganRepository->getTableName();
        $relation = array(
            $kendaraan => function($query) { return $this->kendaraanRepository->selectDetailInfoTransaksiRelationColumn($query); },
            $pelanggan => function($query) { return $this->pelangganRepository->selectTransaksiRelationColumn($query); }
        );

        $detailInfo = $this->transaksiRepository->getDetailInfoRecipt($kodeTransaski, $relation);
        $detailInfoWithRecipt = $this->generateRecipteStatus($detailInfo);

        return $detailInfo->id_pelanggan == $idPelanggan ? $detailInfoWithRecipt : abort(404);
    }
    
    private function generateRecipteStatus($modelTransaksi)
    {
        $status = $this->getCurrentStatusTransaksi($modelTransaksi->status_transaksi);
        if($status == "Transaksi Dalam Proses") {
            $status = $this->getCurrentStatusBayar($modelTransaksi->status_pembayaran, $modelTransaksi->is_transfer);
            if($status == "Pembayaran Terkonfirmasi") {
                $status = $this->getCurrentStatusPengembalian($modelTransaksi->status_pengembalian, $modelTransaksi->is_diantar);
            }
        }
        $modelTransaksi->makeHidden(['status_transaksi', 'status_pembayaran', 'status_pengembalian', 'is_transfer', 'is_diantar']); 
        $modelTransaksi->setAttribute('status_recipt', $status);
        return $modelTransaksi;
    }

    private function getCurrentStatusBayar($statusBayar, $isTransfer)
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

    private function getCurrentStatusPengembalian($statusPengembalian, $isDiantar)
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

    private function getCurrentStatusTransaksi($statusTransaksi) 
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
}