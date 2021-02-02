<?php

namespace App\Http\Controllers\Pelanggan;

use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Services\FileService;
use App\Services\PelangganService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Pelanggan\ProfileRequest;

final class ProfilePageController extends Controller 
{
    private $authService;
    private $fileService;
    private $pelangganService;

    public function __construct(AuthService $authService, PelangganService $pelangganService, FileService $fileService)
    {
        $this->fileService = $fileService;
        $this->authService = $authService;
        $this->pelangganService = $pelangganService;
    }

    public function index() 
    {
        $userId = $this->authService->getActivePelangganId();
        $profileData = $this->pelangganService->getProfileData($userId);
        return view('pelanggan.profile', compact('profileData'));
    }

    public function update(ProfileRequest $request, $id)
    {
        $newData = $request->validated();

        $this->fileService->store($id, $request->file('gambar'));
        $newData['gambar'] = $this->fileService->getProcessedFileData();

        $this->pelangganService->updateProfileData($id, $newData);
        return redirect()->back()->with("status", 'success update profile');
    }

    public function logout(Request $request) 
    {
        $this->authService->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('pelanggan.login.index');
    }
}