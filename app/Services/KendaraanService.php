<?php

namespace App\Services;

use App\Repositories\KendaraanRepository;
use App\Repositories\CabangRepository;

final class KendaraanService 
{

    private $kendaraanRepository;
    private $cabangRepository;

    public function __construct(KendaraanRepository $kendaraanRepository, CabangRepository $cabangRepository)
    {
        $this->kendaraanRepository = $kendaraanRepository;   
        $this->cabangRepository = $cabangRepository;
    }

    public function getCompileOutlineInfoKendaraan() 
    {
        return $this->kendaraanRepository->getOutlineInfoKendaraan(
            $this->cabangRepository->getTableName(),
            function($query) {$this->cabangRepository->selectKendaraanRelationColumn($query);},
            function($query) {$this->cabangRepository->filterActiveCabang($query);}
        );
    }

    public function getCompileDetailInfoKendaraan($id) 
    {
        return $this->kendaraanRepository->getDetailInfoKendaraan(
            $id, 
            $this->cabangRepository->getTableName(),
            function($query) {$this->cabangRepository->selectKendaraanRelationColumn($query);},
            function($query) {$this->cabangRepository->filterActiveCabang($query);}
        );
    }
}