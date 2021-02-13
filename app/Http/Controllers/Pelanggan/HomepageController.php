<?php

namespace App\Http\Controllers\Pelanggan;

use App\Services\ProductService;
use App\Http\Controllers\Controller;
use App\Http\Requests\pelanggan\FilterOutlineProductRequest;

final class HomepageController extends Controller
{
    private $paginate = 8;
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index() 
    {
        $outlineInfo = $this->productService->getOutlineInfo($this->paginate);
        return view('pelanggan.pages.home', compact('outlineInfo'));
    }

    public function filter(FilterOutlineProductRequest $request)
    {
        $validatedData = $request->validated();
        $filter = array_filter($validatedData, function($key) { return $key == 'jenis';}, ARRAY_FILTER_USE_KEY);
        $filterRelation = array_filter($validatedData, function($key) { return $key == 'id_kota';}, ARRAY_FILTER_USE_KEY);
        $outlineInfo = $this->productService->getOutlineInfo($this->paginate, $filter, $filterRelation);
        return view('pelanggan.home', compact('outlineInfo'))->with('filterData', $validatedData);
    }
}