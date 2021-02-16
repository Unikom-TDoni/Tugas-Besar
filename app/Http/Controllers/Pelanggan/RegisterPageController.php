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
        return view('pelanggan.pages.register');
    }

    public function store(RegisterRequest $request)
    {
        $validatedData = $request->validated();
        $this->accountService->register($validatedData);
        return redirect()->route('pelanggan.login.index');
    }
}