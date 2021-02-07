<?php

namespace App\Services;

use App\Repositories\KendaraanRepository;
use App\Repositories\CabangRepository;

final class ProductService 
{
    private $cabangRepository;
    private $kendaraanRepository;

    public function __construct(KendaraanRepository $kendaraanRepository, CabangRepository $cabangRepository)
    {
        $this->kendaraanRepository = $kendaraanRepository;   
        $this->cabangRepository = $cabangRepository;
    }

    /**
     * Get Outline Product Info
     * 
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getOutlineInfo() 
    {
        return $this->kendaraanRepository->getOutlineInfoKendaraan(
            $this->cabangRepository->getTableName(),
            function($query) { return $this->cabangRepository->filterActiveCabang($query); },
            function($query) { return $this->cabangRepository->selectKendaraanRelationColumn($query); },
        );
    }

    /**
     * Get detail product info
     * 
     * @param PrimaryKey @id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getDetailInfo($id) 
    {
        return $this->kendaraanRepository->getDetailInfoKendaraan(
            $id, 
            $this->cabangRepository->getTableName(),
            function($query) { return $this->cabangRepository->filterActiveCabang($query); },
            function($query) { return $this->cabangRepository->selectKendaraanRelationColumn($query); },
        );
    }
}