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
    
    public function store($validatedData) 
    {
        $this->reviewRepository->store($validatedData);
    }

    public function getListInfo($idKendaraan) 
    {
        $pelanggan = $this->pelangganRepository->getTableName();
        $relation = [
            $pelanggan => function($query) { $this->pelangganRepository->selectReviewRelation($query); }
        ];
        return $this->reviewRepository->getActiveReview($idKendaraan, $relation);
    }
}