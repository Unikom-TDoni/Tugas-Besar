<?php

namespace App\Http\Controllers\Pelanggan;

use App\Services\AuthService;
use App\Services\ReciptService;
use App\Services\BookingService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Pelanggan\TransaksiRequest;

final class TransaksiPageController extends Controller
{
    private $authService;
    private $bookingService;

    public function __construct(BookingService $bookingService, AuthService $authService) 
    {
        $this->authService = $authService;
        $this->bookingService = $bookingService;
    }

    public function index($kendaraanId) 
    {
        $currentPelangganId = $this->authService->getActivePelangganId();
        $dataTransaksi = $this->bookingService->getInitBookingFormData($currentPelangganId, $kendaraanId);
        return view('pelanggan.transaksi', compact('dataTransaksi'));
    }

    public function store(TransaksiRequest $request)
    {
        $validatedData = $request->validated();
        $this->bookingService->create($validatedData);
        return redirect()->route('pelanggan.recipt.index');
    }
}
