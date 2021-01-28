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

    public function selectKendaraanRelationColumn($query) 
    {
        return $query->select(['id_cabang','nama_cabang']);
    }

    public function filterActiveCabang($query) 
    {
        return $query->where('is_aktif', 1);
    }

    public function getTableName() 
    {
        return 'cabang';
    }
}