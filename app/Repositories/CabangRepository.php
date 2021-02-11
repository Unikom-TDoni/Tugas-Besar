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
     * Select outline relation with kendaraan
     * 
     * @param \Illuminate\Database\Query\Builder $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function selectKendaraanOutlineInfoRelation($query) 
    {
        return $query->select(['id_cabang', 'nama_cabang', 'id_kota']);
    }

    /**
     * Select detail relation with kendaraan
     * 
     * @param \Illuminate\Database\Query\Builder $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function selectKendaraanDetailInfoRelation($query) 
    {
        return $query->select(['id_cabang', 'nama_cabang', 'telp', 'alamat', 'id_kota', 'id_provinsi']);
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
     * Filter kota
     * 
     * @param \Illuminate\Database\Query\Builder $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function filterKota($query, $idKota) 
    {
        return $query->where('id_kota', $idKota);
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