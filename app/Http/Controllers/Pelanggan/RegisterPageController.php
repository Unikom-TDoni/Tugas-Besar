<?php

namespace App\Http\Controllers\Pelanggan;

use App\Services\AccountService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Pelanggan\RegisterRequest;

final class RegisterPageController extends Controller 
{
    private $accountService;

    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }

    public function index() 
    {
        return view('pelanggan.register');
    }

    public function store(RegisterRequest $request)
    {
        $this->accountService->register($request->validated());
        return redirect()->route('pelanggan.login.index');
    }
}