<?php

namespace App\Http\Controllers\Pelanggan;

use App\Services\AuthService;
use App\Services\ReviewService;
use App\Services\BookingService;
use App\Services\ProductService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Pelanggan\BookingRequest;

final class ProductDetailPageController extends Controller
{ 
    private $authService;
    private $reviewService;
    private $productService;
    private $bookingService;

    public function __construct(AuthService $authService, 
        ProductService $productService, 
        BookingService $bookingService,
        ReviewService $reviewService)
    {
        $this->authService = $authService;
        $this->reviewService = $reviewService;
        $this->productService = $productService;
        $this->bookingService = $bookingService;
    }
    
    public function index($id) 
    {
        $limitRelatedInfo = 6;
        $reviewInfo = $this->reviewService->getListInfo($id);
        $detailInfo = $this->productService->getDetailInfo($id);
        $relatedKey = [
            'jenis' => $detailInfo->jenis,
            'merk' => $detailInfo->merk
        ];
        $outlineInfo = $this->productService->getRelatedOutlineInfo($relatedKey, $limitRelatedInfo);
        return view('pelanggan.pages.detail', compact('outlineInfo', 'detailInfo', 'reviewInfo')); 
    }

    public function show($id)
    {
        $idPelanggan = $this->authService->getActivePelangganId();
        $dataTransaksi = $this->bookingService->getInitBookingFormData($idPelanggan, $id);
        return view('pelanggan.transaksi', compact('dataTransaksi'));
    }

    public function store(BookingRequest $request)
    {
        $validatedData = $request->validated();
        $this->bookingService->create($validatedData);
        return redirect()->route('pelanggan.recipt.index');
    }
}