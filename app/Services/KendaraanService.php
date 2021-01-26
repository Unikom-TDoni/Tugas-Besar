<?php

namespace App\Services;

use App\Repositories\KendaraanRepository;
use App\Repositories\CabangRepository;

final class KendaraanService {

    private $kendaraanRepository;
    private $cabangRepository;

    public function __construct(KendaraanRepository $kendaraanRepository, CabangRepository $cabangRepository)
    {
        $this->kendaraanRepository = $kendaraanRepository;   
        $this->cabangRepository = $cabangRepository;
    }

    /**
     * 
     */
    public function getCompileOutlineInfoKendaraan() 
    {
        $queryKendaraan = $this->kendaraanRepository->getQueryOutlineInfoKendaraan($this->cabangRepository::kendaraanRelation);
        $filteredCabang = $this->cabangRepository->filterAktifCabangQuery($queryKendaraan);
        return $filteredCabang->get();
    }
}