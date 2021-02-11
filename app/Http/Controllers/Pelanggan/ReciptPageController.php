<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use App\Services\BookingService;
use App\Services\ReciptService;

final class ReciptPageController extends Controller
{
    private $authService;
    private $reciptService;
    private $bookingService;

    public function __construct(ReciptService $reciptService, AuthService $authService, BookingService $bookingService)
    {
        $this->authService = $authService;
        $this->reciptService = $reciptService;
        $this->bookingService = $bookingService;
    }

    public function index()
    {
        $currentPelangganId = $this->authService->getActivePelangganId();
        $outlineInfo = $this->reciptService->getOutlineInfo($currentPelangganId);
        return view('pelanggan.recipt', compact('outlineInfo'));
    }

    public function show($kodeTransaksi) 
    {
        $currentPelangganId = $this->authService->getActivePelangganId();
        $detailInfo = $this->reciptService->getDetailInfo($kodeTransaksi, $currentPelangganId);
        return view('pelanggan.recipt-detail', compact('detailInfo'));
    }

    public function confrim($kodeTransaksi)
    {
        $this->bookingService->confrimTransferPayment($kodeTransaksi);
        return redirect()->back();
    }
}
