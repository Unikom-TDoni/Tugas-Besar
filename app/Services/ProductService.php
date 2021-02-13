<?php

namespace App\Services;

use App\Repositories\KendaraanRepository;
use App\Repositories\CabangRepository;
use App\Repositories\KotaRepository;

final class ProductService 
{
    private $kotaRepository;
    private $cabangRepository;
    private $kendaraanRepository;

    public function __construct(KendaraanRepository $kendaraanRepository, CabangRepository $cabangRepository, KotaRepository $kotaRepository)
    {
        $this->cabangRepository = $cabangRepository;
        $this->kendaraanRepository = $kendaraanRepository; 
        $this->kotaRepository = $kotaRepository;
    }

    /**
     * Get Outline Product Info
     * 
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getOutlineInfo(array $filter = null) 
    {
        $kota = $this->kotaRepository->getTableName();
        $cabang = $this->cabangRepository->getTableName();
        $relation = array(
            $cabang => function($query) { $this->cabangRepository->selectOutlineInfoKendaraanRelation($query); }, 
            $cabang.'.'.$kota => function($query) { $this->kotaRepository->selectCabangRelation($query); },
        );

        $idKota = null;
        if(isset($filter['id_kota'])) {
            $idKota = $filter['id_kota'];
            unset($filter['id_kota']);
        }

        return $this->kendaraanRepository->getOutlineInfo(
            $relation,
            function($query) use ($idKota) 
            { 
                $cabangQuery = $this->cabangRepository->filterActiveCabang($query);
                return isset($idKota) ?
                    $this->cabangRepository->filterKota($cabangQuery, $idKota) :
                    $cabangQuery;
            },
            $filter
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
        $kota = $this->kotaRepository->getTableName();
        $cabang = $this->cabangRepository->getTableName();
        $relation = array(
            $cabang => function($query) { $this->cabangRepository->selectDetailInfoKendaraanRelation($query); }, 
            $cabang.'.'.$kota => function($query) { $this->kotaRepository->selectCabangRelation($query); }
        );

        return $this->kendaraanRepository->getDetailInfo(
            $id, 
            $relation,
            function($query) { return $this->cabangRepository->filterActiveCabang($query); },
        );
    }
}