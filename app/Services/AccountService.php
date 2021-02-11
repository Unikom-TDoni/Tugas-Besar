<?php

namespace App\Services;

use App\Repositories\PelangganRepository;

final class AccountService 
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
     */
    public function register(array $validatedData)
    {   
        $this->pelangganRepository->create($validatedData);
    }

    /**
     * Get Pelanggan Profile 
     * 
     * @param PrimaryKey $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getProfileData($id)
    {
        return $this->pelangganRepository->getDataProfile($id);
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

        $this->pelangganRepository->update($id, $validatedData);
    }

    /**
     * Is profile data is complate
     * 
     * @param PrimaryKey @id
     * @return boolean
     */
    public function isProfileComplate($id) 
    {
        $profileData = $this->pelangganRepository->getDataProfile($id)->toArray();
        return empty(
            array_filter(
                $profileData, 
                function ($val, $key) { return $val === null && $key !== 'gambar';},
                ARRAY_FILTER_USE_BOTH
            ));
    }
}