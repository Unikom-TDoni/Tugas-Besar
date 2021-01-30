<?php

namespace App\Http\Controllers\Pelanggan;

use App\Services\KendaraanService;
use App\Http\Controllers\Controller;

final class ProductDetailPageController extends Controller
{ 
    private $kendaraanService;

    public function __construct(KendaraanService $kendaraanService)
    {
        $this->kendaraanService = $kendaraanService;
    }
    
    public function index($id) 
    {
        $detailInfo = $this->kendaraanService->getCompileDetailInfoKendaraan($id);
        return view('pelanggan.product-detail', compact('detailInfo')); 
    }
}