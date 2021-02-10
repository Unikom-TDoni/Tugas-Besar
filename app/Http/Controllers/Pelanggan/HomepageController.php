<?php

namespace App\Http\Controllers\Pelanggan;

use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Controllers\Controller;

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

    public function filter(Request $request)
    {
        $filterData = array_filter($request->except('_token'));
        $outlineInfo = $this->productService->getOutlineInfo($filterData);
        return view('pelanggan.home', compact('outlineInfo','filterData'));
    }
}