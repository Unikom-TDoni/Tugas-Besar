<?php   

namespace App\Repositories;

use App\Models\Pelanggan;
use App\Repositories\Base\BaseRepository;

final class PelangganRepository extends BaseRepository
{
    public function __construct(Pelanggan $model) 
    {
        parent::__construct($model);
    }

    public function insert($attribute) 
    {
        $this->model->create($attribute);
    }
}