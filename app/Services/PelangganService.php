<?php

namespace App\Services;

use App\Repositories\PelangganRepository;

final class PelangganService {
    
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
    public function register($validatedData)
    {   
        $this->pelangganRepository->insert($validatedData);
    }
}