<?php

namespace App\Http\Controllers\Pelanggan;

use App\Services\AuthService;
use App\Services\ReviewService;
use App\Services\ReciptService;
use App\Services\BookingService;
use App\Http\Controllers\Controller;
use App\Http\Requests\pelanggan\ReviewRequest;

final class ReciptPageController extends Controller
{
    private $authService;
    private $reciptService;
    private $reviewService;
    private $bookingService;

    public function __construct(AuthService $authService, ReciptService $reciptService, ReviewService $reviewService, BookingService $bookingService)
    {
        $this->authService = $authService;
        $this->reviewService = $reviewService;
        $this->reciptService = $reciptService;
        $this->bookingService = $bookingService;
    }

    public function index()
    {
        $idPelanggan = $this->authService->getActivePelangganId();
        $outlineInfo = $this->reciptService->getListInfo($idPelanggan);
        return view('pelanggan.recipt', compact('outlineInfo'));
    }

    public function confrim($kodeTransaksi)
    {
        $this->bookingService->confrimTransferPayment($kodeTransaksi);
        return redirect()->back();
    }
    
    public function storeReview(ReviewRequest $request) 
    {
        $validatedData = $request->validated();
        $this->reviewService->store($validatedData);
        return redirect()->back()->with('status', 'Success To Add Review');
    }
}