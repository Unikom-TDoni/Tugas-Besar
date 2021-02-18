<?php

namespace App\Services;

use App\Repositories\CabangRepository;
use App\Repositories\KendaraanRepository;
use App\Repositories\PelangganRepository;
use App\Repositories\TransaksiRepository;
use App\Repositories\BankAccountRepository;

final class BookingService 
{
    private $cabangRepository;
    private $transaksiRepository;
    private $pelangganRepository;
    private $kendaraanRepository;
    private $bankAccountRepository;

    public function __construct(TransaksiRepository $transaksiRepository, 
        PelangganRepository $pelangganRepository, 
        KendaraanRepository $kendaraanRepository, 
        BankAccountRepository $bankAccountRepository,
        CabangRepository $cabangRepository)
    {
        $this->cabangRepository = $cabangRepository;
        $this->transaksiRepository = $transaksiRepository;
        $this->pelangganRepository = $pelangganRepository;
        $this->kendaraanRepository = $kendaraanRepository;
        $this->bankAccountRepository = $bankAccountRepository;
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
     * Update booking bank account
     * 
     * @param PrimaryKey $kodeTransaksi
     * @param array $validatedData
     */
    public function updateBookingBankAccount($kodeTransaksi, array $validatedData) 
    {
        $idBankAccount = $this->bankAccountRepository->create($validatedData);
        $updatedData = ['id_bank_account' => $idBankAccount];
        $this->transaksiRepository->update($kodeTransaksi, $updatedData);
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
        $cabang = $this->cabangRepository->getTableName();
        $relation = [
            $cabang => function($query) { $this->cabangRepository->selectOutlineInfoKendaraanRelation($query); }
        ];

        $pelanggan = $this->pelangganRepository->getFormBookingData($idPelanggan);
        $kendaraan = $this->kendaraanRepository->getFormBookingData($idKendaraan, $relation);
        return compact('pelanggan', 'kendaraan');
    }
}