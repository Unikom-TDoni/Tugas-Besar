<?php

namespace App\Http\Controllers\Pelanggan;

use App\Services\AuthService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\RateLimiter;
use App\Http\Requests\Pelanggan\LoginRequest;

final class LoginPageController extends Controller 
{
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function index() 
    {
        return view('pelanggan.login');
    }

    public function store(LoginRequest $request) 
    {
        return $this->authService->authenticate($request->validated(), 
            [$this, 'onLoginSuccess'], 
            [$this, 'onLoginFail']
        );
    }

    public function onLoginSuccess($limitKey) 
    {
        RateLimiter::clear($limitKey);
        return redirect()->route('pelanggan.homepage.index');
    }

    public function onLoginFail() 
    {
        return redirect()->route('pelanggan.login.index');
    }
}