<?php

namespace App\Services;

use App\Repositories\ReviewRepository;
use App\Repositories\PelangganRepository;

final class ReviewService 
{
    private $reviewRepository;
    private $pelangganRepository;

    public function __construct(ReviewRepository $reviewRepository, PelangganRepository $pelangganRepository)
    {
        $this->reviewRepository = $reviewRepository;
        $this->pelangganRepository = $pelangganRepository;
    }
    
    /**
     * Create review
     * 
     * @param array $validatedData
     */
    public function create($validatedData) 
    {
        $this->reviewRepository->create($validatedData);
    }

    /**
     * @param PrimaryKey $idKendaraan
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getListInfo($idKendaraan) 
    {
        $pelanggan = $this->pelangganRepository->getTableName();
        $relation = [
            $pelanggan => function($query) { $this->pelangganRepository->selectReviewRelation($query); }
        ];
        
        return $this->reviewRepository->getActiveReview($idKendaraan, $relation);
    }
}