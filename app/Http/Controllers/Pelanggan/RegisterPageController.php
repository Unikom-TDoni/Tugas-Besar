<?php

namespace App\Http\Controllers\Pelanggan;

use App\Services\PelangganService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Pelanggan\RegisterRequest;

final class RegisterPageController extends Controller 
{
    private $pelangganService;

    public function __construct(PelangganService $pelangganService)
    {
        $this->pelangganService = $pelangganService;
    }

    public function index() 
    {
        return view('pelanggan.register');
    }

    public function store(RegisterRequest $request)
    {
        $this->pelangganService->Register($request->validated());
        return redirect()->route('pelanggan.login.index');
    }
}