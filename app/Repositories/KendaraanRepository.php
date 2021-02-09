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
    public function getOutlineInfoKendaraan(string $relation, Closure $filterActiveCabang, Closure $selectDataCabang)
    {
        return $this->model
            ->whereHas($relation, $filterActiveCabang)
            ->with([$relation => $selectDataCabang])
            ->selectraw('id_kendaraan, id_cabang, nama_kendaraan, harga_sewa, jenis, gambar, (jumlah_kendaraan - jumlah_terpakai) AS jumlah_tersedia')
            ->having('jumlah_tersedia','>', 0)
            ->get();
    }

    /**
     * Get detail info kendaraan
     * 
     * @param PrimaryKey $id
     * @param string $relation
    *  @param Closure $filterActiveCabang
     * @param Closure $selectDataCabang
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getDetailInfoKendaraan($id, $relation, Closure $filterActiveCabang, Closure $selectDataCabang) 
    {
        return $this->model
            ->whereHas($relation, $filterActiveCabang)
            ->with([$relation => $selectDataCabang])
            ->find($id, ['id_kendaraan', 'id_cabang', 'merk', 'nama_kendaraan', 'harga_sewa', 'jenis', 'gambar']);
    }

    /**
     * To Select Outline Info For Transaksi Relation
     * 
     * @param \Illuminate\Database\Query\Builder $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function selectOutlineInfoTransaksiRelationColumn($query)
    {
        return $query->select(['id_kendaraan', 'nama_kendaraan', 'gambar']);
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