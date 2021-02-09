<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Services\ProductService;

final class HomepageController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index() 
    {
        $outlineInfo = $this->productService->getOutlineInfo();
        return view('pelanggan.home', compact('outlineInfo'));
    }
}
