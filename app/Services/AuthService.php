<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

final class AuthService 
{
    /**
     * Handle Auth/Login
     * 
     * @return boolean
     */
    public function authenticate(array $validatedData, callable $onSuccessCallback, callable $onFailCallback)
    {
        $remember = array_pop($validatedData);
        return Auth::guard('pelanggan')->attempt($validatedData, $remember) ?
                    $onSuccessCallback($validatedData['email']) :
                    $onFailCallback();
    }

    /**
     * Handle Logout
     */
    public function logout() 
    {
        Auth::guard('pelanggan')->logout();
    }

    /**
     * Get current active pelanggan Id
     * 
     * @return PrimaryKey
     */
    public function getActivePelangganId()
    {
        return Auth::guard('pelanggan')->user()->id;
    }
}