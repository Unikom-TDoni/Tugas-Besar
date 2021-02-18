<?php   

namespace App\Repositories;

use App\Models\Kendaraan;
use App\Repositories\Base\BaseRepository;

final class KendaraanRepository extends BaseRepository
{
    public function __construct(Kendaraan $model) 
    {
        parent::__construct($model);
    }

    /**
     * Get Form Booking Initial Data
     * 
     * @param PrimaryKey $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getFormBookingData($id, array $relation)
    {
        return $this->model->with($relation)
            ->findOrFail($id, [
                'id_kendaraan', 
                'nama_kendaraan', 
                'harga_sewa',
                'nomor_plat',
                'gambar',
                'warna',
                'jenis',
                'tahun',
                'merk',
            ]);
    }

    /**
     * Get outline info of kendaraan for the homepage
     * 
     * @param array $relation
     * @param array $filterCabang
     * @param array $filter
     * @param int $paginate
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getOutlineInfo(array $relation, array $filterRelation, array $filter = null, $paginate)
    {
        $query = $this->model->with($relation);
        $query = $this->generateRelationFilterQuery($query, $filterRelation);
        if(isset($filter)) $query = $this->generateFilterQuery($query, $filter);
        return $query->paginate($paginate, [
            'id_cabang',
            'id_kendaraan', 
            'nama_kendaraan',
            'harga_sewa',
            'deskripsi',
            'gambar',
            'warna',
            'jenis',
            'tahun',
            'merk' 
        ]);
    }

    /**
     * Get detail info kendaraan
     * 
     * @param PrimaryKey $id
     * @param array $relation
    *  @param array $whereHasRelation
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getDetailInfo($id, array $relation, array $filterRelation) 
    {
        $query = $this->model->with($relation);
        $query = $this->generateRelationFilterQuery($query, $filterRelation);
        return $query->findOrFail($id, [
                'id_cabang', 
                'id_kendaraan', 
                'nama_kendaraan', 
                'harga_sewa', 
                'nomor_plat',
                'deskripsi',
                'gambar',
                'jenis', 
                'merk' ,
                'warna',
                'tahun',
                'denda'
            ]);
    }

    /**
     * Get related info of kendaraan for the detail page
     * 
     * @param array $relation
     * @param array $filterRelation
     * @param array $relatedInfo
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRelatedInfo(array $relation, array $filterRelation, array $relatedInfo, $limit) 
    {
        $query = $this->model->with($relation);
        $query = $this->generateRelationFilterQuery($query, $filterRelation);
        $query = $this->generateFilterRelatedQuery($query, $relatedInfo);
        return $query
            ->limit($limit)
            ->get([
                'id_cabang',
                'id_kendaraan', 
                'nama_kendaraan',
                'harga_sewa',
                'deskripsi',
                'gambar',
                'warna',
                'jenis',
                'tahun',
                'merk' 
            ]);
    }

    /**
     * Select Outline Info Transaksi Relation
     * 
     * @param \Illuminate\Database\Query\Builder $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function selectOutlineInfoTransaksiRelation($query)
    {
        return $query->select([
            'id_cabang', 
            'id_kendaraan', 
            'nama_kendaraan', 
            'nomor_plat',
            'harga_sewa',
            'deskripsi',
            'gambar',
            'jenis',
            'warna',
            'tahun',
            'merk' 
        ]);
    }

    /**
     * Select Detail Info Transaksi Relation
     * 
     * @param \Illuminate\Database\Query\Builder $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function selectDetailInfoTransaksiRelation($query)
    {
        return $query->select([
            'id_cabang', 
            'id_kendaraan', 
            'nama_kendaraan', 
            'harga_sewa', 
            'nomor_plat',
            'deskripsi',
            'gambar',
            'jenis', 
            'merk' ,
            'warna',
            'tahun',
            'denda'
        ]);
    }

    /**
     * Get Table Name
     * 
     * @return string
     */
    public function getTableName() 
    {
        return 'kendaraan';
    }

    /**
     * Generate filter based on related info query
     * 
     * @param \Illuminate\Database\Query\Builder $query
     * @param array $relatedInfo
     * @return \Illuminate\Database\Query\Builder
     */
    private function generateFilterRelatedQuery($query, array $relatedInfo) 
    {
        foreach($relatedInfo as $key => $value)
            $query = $query->orWhere($key, $value);
        return $query;
    }

    /**
     * Generate filter query
     * 
     * @param \Illuminate\Database\Query\Builder $query
     * @param array $filter
     * @return \Illuminate\Database\Query\Builder
     */
    private function generateFilterQuery($query, array $filter) 
    {
        foreach($filter as $key => $value)
            $query = $query->where($key, $value);
        return $query;
    }

    /**
     * Generate relation filter query
     * 
     * @param \Illuminate\Database\Query\Builder $query
     * @param array $filterRelation
     * @return \Illuminate\Database\Query\Builder
     */
    private function generateRelationFilterQuery($query, array $filterRelation) 
    {
        foreach($filterRelation as $key => $value)
            $query = $query->whereHas($key, $value);
        return $query;
    }
}