<?php

namespace App\Services;

use App\Repositories\KendaraanRepository;
use App\Repositories\CabangRepository;
use App\Repositories\KotaRepository;
use App\Repositories\ProvinsiRepository;

final class ProductService 
{
    private $kotaRepository;
    private $cabangRepository;
    private $provinsiRepository;
    private $kendaraanRepository;

    public function __construct(KendaraanRepository $kendaraanRepository, 
        CabangRepository $cabangRepository, 
        KotaRepository $kotaRepository,
        ProvinsiRepository $provinsiRepository)
    {
        $this->kotaRepository = $kotaRepository;
        $this->cabangRepository = $cabangRepository;
        $this->provinsiRepository = $provinsiRepository;
        $this->kendaraanRepository = $kendaraanRepository; 
    }

    /**
     * Get Outline Product Info
     * 
     * @param int $paginate
     * @param array|null $filter
     * @param array|null $relationFilter
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getOutlineInfo($paginate, array $filter = null, array $relationFilter = null) 
    {
        $kota = $this->kotaRepository->getTableName();
        $cabang = $this->cabangRepository->getTableName();
        $relation = [
            $cabang => function($query) { $this->cabangRepository->selectOutlineInfoKendaraanRelation($query); }, 
            $cabang.'.'.$kota => function($query) { $this->kotaRepository->selectCabangRelation($query); },
        ];
        
        $filterRelation = [
            $cabang => function($query) use ($relationFilter) { $this->cabangRepository->filterCabang($query, $relationFilter); }
        ];

        return $this->kendaraanRepository->getOutlineInfo($relation, $filterRelation, $filter, $paginate);
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
        $provinsi = $this->provinsiRepository->getTableName();
        $relation = [
            $cabang => function($query) { $this->cabangRepository->selectDetailInfoKendaraanRelation($query); }, 
            $cabang.'.'.$kota => function($query) { $this->kotaRepository->selectCabangRelation($query); },
            $cabang.'.'.$kota.'.'.$provinsi => function($query) { $this->provinsiRepository->selectKotaRelation($query); }
        ];

        $filterRelation = [
            $cabang => function($query) { $this->cabangRepository->filterCabang($query); }
        ];

        return $this->kendaraanRepository->getDetailInfo($id, $relation, $filterRelation);
    }

    /**
     * Get Related Info Current Product
     * 
     * @param array $relatedKey
     * @param int $limitRelatedData
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRelatedOutlineInfo(array $relatedInfo, $limitRelatedData) 
    {
        $kota = $this->kotaRepository->getTableName();
        $cabang = $this->cabangRepository->getTableName();
        $relation = [
            $cabang => function($query) { $this->cabangRepository->selectOutlineInfoKendaraanRelation($query); }, 
            $cabang.'.'.$kota => function($query) { $this->kotaRepository->selectCabangRelation($query); },
        ];

        $filterRelation = [
            $cabang => function($query) { $this->cabangRepository->filterCabang($query); }
        ];

        return $this->kendaraanRepository->getRelatedInfo($relation, $filterRelation, $relatedInfo, $limitRelatedData);
    }
}