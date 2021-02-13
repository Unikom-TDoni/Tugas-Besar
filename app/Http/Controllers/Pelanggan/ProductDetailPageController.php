<?php

namespace App\Http\Controllers\Pelanggan;

use App\Services\ProductService;
use App\Http\Controllers\Controller;
use App\Models\Ulasan;
use Illuminate\Support\Facades\DB;

final class ProductDetailPageController extends Controller
{ 
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    
    public function index($id) 
    {
        $listUlasan= DB::table('ulasan')->get();
        $detailInfo = $this->productService->getDetailInfo($id);
        return view('pelanggan.product-detail', compact('detailInfo','listUlasan')); 
    }

    // public function daftarUlasan(){
    //     $ulasanInfo= Ulasan::all();
    //     return view('pelanggan.product-detail',compact('ulasanInfo'));

    // }
}