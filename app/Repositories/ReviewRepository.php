<?php   

namespace App\Repositories;

use App\Models\Ulasan;
use App\Repositories\Base\BaseRepository;
use Illuminate\Support\Facades\DB;

final class ReviewRepository extends BaseRepository
{
    public function __construct(Ulasan $model) 
    {
        parent::__construct($model);
    }
    
    /**
     * Are it's valid to write review
     * 
     * @param PrimaryKey $kodeTransaksi
     * @return boolean
     */
    public function isValidToWrite($kodeTransaksi) 
    {
        return $this->model
            ->where('kode_transaksi', $kodeTransaksi)
            ->exist();
    }

    /**
     * Get Active Review
     * 
     * @param PrimaryKey $idKendaraan
     * @param array $relation
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getActiveReview($idKendaraan, array $relation) 
    {
        return $this->model
            ->with($relation)
            ->where(['id_kendaraan' => $idKendaraan, 'status' => 1])
            ->get(['id', 'id_pelanggan', 'ulasan', 'rating', 'created_at']);
    }
    
    /**
     * Store Review
     * 
     * @param array $validatedData
     */
    public function store(array $validatedData) 
    {
        DB::table('ulasan')->insert([
            'kode_transaksi'=>$validatedData['kode_transaksi'],
            'id_kendaraan'=>$validatedData['id_kendaraan'],
            'id_pelanggan'=>$validatedData['id_pelanggan'],
            'rating'=>$validatedData['rating'],
            'ulasan'=>$validatedData['ulasan'],
            'nama'=>$validatedData['nama'],
            'telp'=>$validatedData['telp'],
        ]);
    }
}