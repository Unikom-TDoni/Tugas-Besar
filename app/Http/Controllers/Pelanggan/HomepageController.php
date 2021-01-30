<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Services\KendaraanService;

final class HomepageController extends Controller
{
    private $kendaraanService;

    public function __construct(KendaraanService $kendaraanService)
    {
        $this->kendaraanService = $kendaraanService;
    }

    public function index() 
    {
        $outlineInfo = $this->kendaraanService->getCompileOutlineInfoKendaraan();
        return view('pelanggan.home', compact('outlineInfo'));
    }
}
