<?php   

namespace App\Repositories;

use App\Models\Provinsi;
use App\Repositories\Base\BaseRepository;

final class ProvinsiRepository extends BaseRepository
{
    public function __construct(Provinsi $model) 
    {
        parent::__construct($model);
    }

    /**
     * Select Kota Relation
     * 
     * @param \Illuminate\Database\Query\Builder $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function selectKotaRelation($query) 
    {
        return $query->select(['id', 'nama']);
    }

    /**
    * To Get Table Name
    * 
    * @return string
    */
    public function getTableName() 
    {
        return 'provinsi';
    }
}