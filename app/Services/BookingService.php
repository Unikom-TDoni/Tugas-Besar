<?php

namespace App\Services;

use App\Repositories\KendaraanRepository;
use App\Repositories\PelangganRepository;
use App\Repositories\TransaksiRepository;

final class BookingService 
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

    /**
     * Create booking request
     * 
     * @param array $validatedData
     */
    public function create(array $validatedData)
    {
        $this->transaksiRepository->create($validatedData);
    }
    
    /**
     * To confrim transfer payment
     * 
     * @param PrimaryKey @kodeTransaksi
     */
    public function confrimTransferPayment($kodeTransaski) 
    {
        //menunggu konfirmasi admin
        $status = 1;
        $this->transaksiRepository->updateStatusPembayaran($kodeTransaski, $status);
    }

    /**
     * Get Booking Form Init Data
     * 
     * @param PrimaryKey $idPelanggan
     * @param PrimaryKey $idKendaraan
     * @return array
     */
    public function getInitBookingFormData($idPelanggan, $idKendaraan) 
    {
        $pelanggan = $this->pelangganRepository->getFormBookingData($idPelanggan);
        $kendaraan = $this->kendaraanRepository->getFormBookingData($idKendaraan);
        return compact('pelanggan', 'kendaraan');
    }
}