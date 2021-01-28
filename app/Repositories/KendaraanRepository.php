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
     * Get outline info of kendaraan for the homepage
     * 
     * @return 
     */
    public function getOutlineInfoKendaraan($relation, $selectCabangRelation, $filterActiveCabang)
    {
        return $this->model
                ->whereHas($relation, $filterActiveCabang)
                ->with([$relation => $selectCabangRelation])
                ->selectraw('id_kendaraan, id_cabang, nama_kendaraan, harga_sewa, jenis, gambar, (jumlah_kendaraan - jumlah_terpakai) AS jumlah_tersedia')
                ->having('jumlah_tersedia','>', 0)
                ->get();
    }

    public function getDetailInfoKendaraan($id, $relation, $selectCabangRelation, $filterActiveCabang) 
    {
        return $this->model
                ->whereHas($relation, $filterActiveCabang)
                ->with([$relation => $selectCabangRelation])
                ->find($id, ['id_kendaraan', 'id_cabang', 'merk', 'nama_kendaraan', 'harga_sewa', 'jenis', 'gambar']);
    }
}