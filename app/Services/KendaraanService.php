<?php

namespace App\Services;

use App\Repositories\KendaraanRepository;
use App\Repositories\CabangRepository;

final class KendaraanService 
{
    private $cabangRepository;
    private $kendaraanRepository;

    public function __construct(KendaraanRepository $kendaraanRepository, CabangRepository $cabangRepository)
    {
        $this->kendaraanRepository = $kendaraanRepository;   
        $this->cabangRepository = $cabangRepository;
    }

    public function getCompileOutlineInfoKendaraan() 
    {
        return $this->kendaraanRepository->getOutlineInfoKendaraan(
            $this->cabangRepository->getTableName(),
            function($query) { return $this->cabangRepository->filterActiveCabang($query); },
            function($query) { return $this->cabangRepository->selectKendaraanRelationColumn($query); },
        );
    }

    public function getCompileDetailInfoKendaraan($id) 
    {
        return $this->kendaraanRepository->getDetailInfoKendaraan(
            $id, 
            $this->cabangRepository->getTableName(),
            function($query) { return $this->cabangRepository->filterActiveCabang($query); },
            function($query) { return $this->cabangRepository->selectKendaraanRelationColumn($query); },
        );
    }
}