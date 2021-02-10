<?php   

namespace App\Repositories;

use Closure;
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
    public function getFormBookingData($id)
    {
        return $this->model->findOrFail($id, ['id_kendaraan', 'nama_kendaraan', 'harga_sewa', 'denda']);
    }

    /**
     * Get outline info of kendaraan for the homepage
     * 
     * @param string $relation
     * @param Closure $filterActiveCabang
     * @param Closure $selectDataCabang
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getOutlineInfoKendaraan(array $relation, Closure $filterCabangRelation, array $filter = null)
    {
        $query = $this->model
            ->with($relation)
            ->whereHas(array_key_first($relation), $filterCabangRelation);
        
        if(isset($filter))
            foreach($filter as $key => $value)
                $query = $query->where($key, $value);

        return $query->get(['id_kendaraan', 'id_cabang', 'nama_kendaraan', 'harga_sewa', 'jenis', 'gambar']);
    }

    /**
     * Get detail info kendaraan
     * 
     * @param PrimaryKey $id
     * @param string $relation
    *  @param Closure $filterCabangRelation
     * @param Closure $selectDataCabang
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getDetailInfoKendaraan($id, array $relation, Closure $filterCabangRelation) 
    {
        return $this->model
            ->with($relation)
            ->whereHas(array_key_first($relation), $filterCabangRelation)
            ->findOrFail($id, ['id_kendaraan', 'id_cabang', 'merk', 'nama_kendaraan', 'harga_sewa', 'jenis', 'gambar']);
    }

    /**
     * To Select Outline Info For Transaksi Relation
     * 
     * @param \Illuminate\Database\Query\Builder $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function selectOutlineInfoTransaksiRelationColumn($query)
    {
        return $query->select(['id_kendaraan', 'id_cabang', 'nama_kendaraan', 'gambar']);
    }

    /**
     * To Select Detail Info For Transaksi Relation
     * 
     * @param \Illuminate\Database\Query\Builder $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function selectDetailInfoTransaksiRelationColumn($query)
    {
        return $query->select(['id_kendaraan', 'id_cabang', 'nama_kendaraan' , 'jenis', 'harga_sewa', 'merk' ,'gambar']);
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
}