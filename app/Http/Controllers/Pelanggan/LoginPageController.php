<?php

namespace App\Http\Controllers\Pelanggan;

use App\Services\AuthService;
use Illuminate\Support\MessageBag;
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
        return view('pelanggan.pages.login');
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
        $errors = new MessageBag(['password' => ['Email and/or password invalid.']]);
        return redirect()->back()->withErrors($errors);
    }
}