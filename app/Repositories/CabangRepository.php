<?php   

namespace App\Repositories;

use App\Models\Cabang;
use App\Repositories\Base\BaseRepository;

final class CabangRepository extends BaseRepository
{
    const kendaraanRelation = 'cabang:id_cabang,nama_cabang,is_aktif';

    public function __construct(Cabang $model) 
    {
        parent::__construct($model);
    }

    public function filterAktifCabangQuery($query) {
        return $query->whereHas('cabang', function($q){
            $q->where('is_aktif', 1);
        });
    }
    
}