<?php   

namespace App\Repositories;

use App\Models\Kota;
use App\Repositories\Base\BaseRepository;

final class KotaRepository extends BaseRepository
{
    public function __construct(Kota $model) 
    {
        parent::__construct($model);
    }

    /**
     * Select Cabang Relation
     * 
     * @param \Illuminate\Database\Query\Builder $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function selectCabangRelation($query) 
    {
        return $query->select(['id', 'nama']);
    }

    /**
     * Get Table Name
     * 
     * @return string
     */
    public function getTableName() 
    {
        return 'kota';
    }
}