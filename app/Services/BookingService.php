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


    // if($validatedData['is_transfer'] == 1) 
    // {
    //         $bankData = array(
    //             'nama_rekening'=> $validatedData['nama_rekening'],  
    //             'nama_bank' => $validatedData['nama_bank'],
    //             'nomor_rekening' => $validatedData['nomor_rekening']);
            
    //         $validatedData['id_bank_account'] = $this->bankAccountRepository->create($bankData);
    //         $validatedData = array_diff_key($validatedData, $bankData);
    // }

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
        $cabang = $this->cabangRepository->getTableName();
        $relation = [
            $cabang => function($query) { $this->cabangRepository->selectOutlineInfoKendaraanRelation($query); }
        ];

        $pelanggan = $this->pelangganRepository->getFormBookingData($idPelanggan);
        $kendaraan = $this->kendaraanRepository->getFormBookingData($idKendaraan, $relation);
        return compact('pelanggan', 'kendaraan');
    }
}