<?php   

namespace App\Repositories;

use App\Models\Cabang;
use App\Repositories\Base\BaseRepository;

final class CabangRepository extends BaseRepository
{
    public function __construct(Cabang $model) 
    {
        parent::__construct($model);
    }

    /**
     * Select relation with kendaraan
     * 
     * @param \Illuminate\Database\Query\Builder $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function selectKendaraanRelationColumn($query) 
    {
        return $query->select(['id_cabang', 'nama_cabang']);
    }

    /**
     * Filter active cabang
     * 
     * @param \Illuminate\Database\Query\Builder $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function filterActiveCabang($query) 
    {
        return $query->where('is_aktif', 1);
    }

    /**
     * Get Table Name
     * 
     * @return string
     */
    public function getTableName() 
    {
        return 'cabang';
    }
}