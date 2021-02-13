<?php

namespace App\Http\Controllers\Pelanggan;

use App\Services\AuthService;
use App\Services\ReviewService;
use App\Services\BookingService;
use App\Services\ProductService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Pelanggan\BookingRequest;
use App\Models\Ulasan;
use Illuminate\Support\Facades\DB;

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
        $review = $this->reviewService->getList();
        $detailInfo = $this->productService->getDetailInfo($id);
        return view('pelanggan.product-detail', compact('detailInfo', 'review')); 
    }

    public function show($id)
    {
        $listUlasan= DB::table('ulasan')->get();

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

    // public function daftarUlasan(){
    //     $ulasanInfo= Ulasan::all();
    //     return view('pelanggan.product-detail',compact('ulasanInfo'));

    // }
}