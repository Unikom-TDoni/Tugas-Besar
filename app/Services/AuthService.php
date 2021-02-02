<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

final class AuthService 
{
    public function authenticate(array $validatedData, callable $onSuccessCallback, callable $onFailCallback)
    {
        $remember = array_pop($validatedData);
        return Auth::guard('pelanggan')->attempt($validatedData, $remember) ?
                    $onSuccessCallback($validatedData['email']) :
                    $onFailCallback();
    }

    public function logout() 
    {
        Auth::guard('pelanggan')->logout();
    }

    public function getActivePelangganId()
    {
        return Auth::guard('pelanggan')->user()->id;
    }
}