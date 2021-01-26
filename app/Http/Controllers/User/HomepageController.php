<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\KendaraanService;
use Illuminate\Support\Facades\DB;

class HomepageController extends Controller
{
    private $kendaraanService;

    public function __construct(KendaraanService $kendaraanService)
    {
        $this->kendaraanService = $kendaraanService;
    }

    public function index() 
    {
        $infoKendaraan = $this->kendaraanService->getCompileOutlineInfoKendaraan();
        return view('user.homepage', compact('infoKendaraan'));
    }
    
    public function showDetailProduct($id) 
    {
        
    }
}
