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
     * Select outline relation 
     * 
     * @param \Illuminate\Database\Query\Builder $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function selectOutlineInfoKendaraanRelation($query) 
    {
        return $query->select(['id_cabang', 'id_kota', 'nama_cabang']);
    }

    /**
     * Select detail relation with kendaraan
     * 
     * @param \Illuminate\Database\Query\Builder $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function selectDetailInfoKendaraanRelation($query) 
    {
        return $query->select(['id_cabang', 'id_kota', 'id_provinsi', 'nama_cabang', 'alamat', 'telp']);
    }

    /**
     * Filter cabang
     * 
     * @param \Illuminate\Database\Query\Builder $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function filterCabang($query, array $filter = null) 
    {
        $query = $query->where('is_aktif', 1);
        if(isset($filter))
            foreach($filter as $key => $value) $query = $query->where($key, $value);
        return $query;
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