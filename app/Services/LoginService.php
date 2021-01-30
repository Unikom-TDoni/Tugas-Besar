<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

final class LoginService 
{
    public function authenticate($validatedData, callable $onSuccessCallback, callable $onFailCallback)
    {
        return Auth::guard('pelanggan')->attempt($validatedData) ?
                    $onSuccessCallback($validatedData['email']) :
                    $onFailCallback();
    }
}