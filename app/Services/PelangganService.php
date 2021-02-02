<?php

namespace App\Services;

use App\Repositories\PelangganRepository;

final class PelangganService 
{
    private $pelangganRepository;
    
    public function __construct(PelangganRepository $pelangganRepository) 
    {
        $this->pelangganRepository = $pelangganRepository;
    }

    /**
     * Handling upcoming register request.
     *
     * @param array $validatedData
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function register(array $validatedData)
    {   
        $this->pelangganRepository->insert($validatedData);
    }

    /**
     * Get Pelanggan Profile 
     * 
     * @param PrimaryKey $id
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getProfileData($id)
    {
        return $this->pelangganRepository->getProfile($id);
    }
    
    /**
     * Update Pelanggan Profile
     * 
     * @param PrimaryKey $id
     * @param array $validatedData
     */
    public function updateProfileData($id, array $validatedData)
    {
        if(is_null($validatedData['gambar']))
            unset($validatedData['gambar']);

        $this->pelangganRepository->updateProfile($id, $validatedData);
    }
}