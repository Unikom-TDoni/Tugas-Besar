<?php   

namespace App\Repositories;

use App\Models\Kendaraan;
use App\Repositories\Base\BaseRepository;
use Closure;

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
    public function getOutlineInfoKendaraan($relation, Closure $cabangActiveFilter, Closure $cabangSelectedColumn)
    {
        return $this->model
                ->whereHas($relation, $cabangActiveFilter)
                ->with([$relation => $cabangSelectedColumn])
                ->selectraw('id_kendaraan, id_cabang, nama_kendaraan, harga_sewa, jenis, gambar, (jumlah_kendaraan - jumlah_terpakai) AS jumlah_tersedia')
                ->having('jumlah_tersedia','>', 0)
                ->get();
    }

    public function getDetailInfoKendaraan($id, $relation, Closure $cabangActiveFilter, Closure $cabangSelectedColumn) 
    {
        return $this->model
                ->whereHas($relation, $cabangActiveFilter)
                ->with([$relation => $cabangSelectedColumn])
                ->find($id, ['id_kendaraan', 'id_cabang', 'merk', 'nama_kendaraan', 'harga_sewa', 'jenis', 'gambar']);
    }
}