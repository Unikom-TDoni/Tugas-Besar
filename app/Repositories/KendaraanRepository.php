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
    public function getQueryOutlineInfoKendaraan($relation)
    {
        return $this->model
                ->with($relation)
                ->selectraw('id_kendaraan, id_cabang, nama_kendaraan, harga_sewa, jenis, gambar, (jumlah_kendaraan - jumlah_terpakai) AS jumlah_tersedia')
                ->having('jumlah_tersedia','>', 0);
    }
}