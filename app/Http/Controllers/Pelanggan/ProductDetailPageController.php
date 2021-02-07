<?php

namespace App\Http\Controllers\Pelanggan;

use App\Services\ProductService;
use App\Http\Controllers\Controller;

final class ProductDetailPageController extends Controller
{ 
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    
    public function index($id) 
    {
        $detailInfo = $this->productService->getDetailInfo($id);
        return view('pelanggan.product-detail', compact('detailInfo')); 
    }
}