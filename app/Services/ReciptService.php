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
        
        $outlineActiveRecipt = $this->transaksiRepository->getOutlineInfoRecipt(
            $idPelanggan,
            $relation
        );

        foreach($outlineActiveRecipt as $item) 
        {
            $recipteStatus = $this->generateRecipteStatus(
                $item->status_transaksi, 
                $item->status_pembayaran, 
                $item->status_pengembalian, 
                $item->is_transfer, 
                $item->is_diantar
            );
            $item->makeHidden(['status_transaksi', 'status_pembayaran', 'status_pengembalian', 'is_transfer', 'is_diantar']); 
            $item->setAttribute('status_recipt', $recipteStatus);
        }
        return $outlineActiveRecipt;
    }
    
    public function getDetailInfo($kodeTransaski, $idPelanggan)
    {
        $kendaraan = $this->kendaraanRepository->getTableName();
        $pelanggan = $this->pelangganRepository->getTableName();
        $relation = array(
            $kendaraan => function($query) { return $this->kendaraanRepository->selectDetailInfoTransaksiRelationColumn($query); },
            $pelanggan => function($query) { return $this->pelangganRepository->selectTransaksiRelationColumn($query); }
        );

        $detailInfo = $this->transaksiRepository->getDetailInfoRecipt(
            $kodeTransaski,
            $relation,
        );

        $recipteStatus = $this->generateRecipteStatus(
            $detailInfo->status_transaksi, 
            $detailInfo->status_pembayaran, 
            $detailInfo->status_pengembalian, 
            $detailInfo->is_transfer, 
            $detailInfo->is_diantar
        );

        $detailInfo->makeHidden(['status_transaksi', 'status_pembayaran', 'status_pengembalian', 'is_transfer', 'is_diantar']); 
        $detailInfo->setAttribute('status_recipt', $recipteStatus);

        return $detailInfo->id_pelanggan == $idPelanggan ? $detailInfo : abort(404);
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

    private function generateRecipteStatus($statusTransaksi, $statusBayar, $statusPengembalian, $isTransfer, $isDiantar)
    {
        $status = $this->getCurrentStatusTransaksi($statusTransaksi);
        if($status == "Transaksi Dalam Proses") {
            $status = $this->getCurrentStatusBayar($statusBayar, $isTransfer);
            if($status == "Pembayaran Terkonfirmasi") {
                $status = $this->getCurrentStatusPengembalian($statusPengembalian, $isDiantar);
            }
        }
        return $status;
    }
}