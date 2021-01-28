<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\KendaraanService;

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
        return view('user.product-detail-page', compact('detailInfo')); 
    }
}