<?php   

namespace App\Repositories;

use App\Models\Pelanggan;
use App\Repositories\Base\BaseRepository;

final class PelangganRepository extends BaseRepository
{
    public function __construct(Pelanggan $model) 
    {
        parent::__construct($model);
    }

    /**
     * To Create New Data
     * 
     * @param array $attribute
     */
    public function create($attribute) 
    {
        $this->model->create($attribute);
    }

    /**
     * Get Profile Data
     * 
     * @param PrimaryKey $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getProfileData($id) 
    {
        return $this->model->findOrFail($id, ['id', 'email', 'nama', 'jenis_kelamin', 'tanggal_lahir', 'telp', 'alamat', 'gambar', 'nomor_ktp']);
    }

    /**
     * Get Form Booking Initial Data
     * 
     * @param PrimaryKey $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getFormBookingData($id)
    {
        return $this->model->findOrFail($id, ['id', 'nama', 'telp', 'alamat', 'nomor_ktp']);
    }
    
    /**
     * Get Data For Reveiw
     * 
     * @param PrimaryKey $id
     * @return \illuminate\Database\Eloquent\Model
     */
    public function getReviewData($id) 
    {
        return $this->model->findOrFail($id, ['id', 'nama', 'telp']);
    }

    /**
     * To Update Existing Data
     * 
     * @param PrimaryKey $id
     * @param array $validatedData
     */
    public  function update($id, array $validatedData)
    {  
        $this->model->findOrFail($id)->update($validatedData);
    }

    /**
    * Select Initial Info Form Pemesanan Transaksi Relation
    * 
    * @param \Illuminate\Database\Query\Builder $query
    * @return \Illuminate\Database\Query\Builder
    */
    public function selectTransaksiRelation($query) 
    {
        return $query->select(['id', 'nama', 'telp']);
    }

    /**
    * Select Data Review Relation
    * 
    * @param \Illuminate\Database\Query\Builder $query
    * @return \Illuminate\Database\Query\Builder
    */
    public function selectReviewRelation($query) 
    {
        return $query->select(['id', 'nama', 'gambar']);
    }

    /**
    * To Get Table Name
    * 
    * @return string
    */
    public function getTableName() 
    {
        return 'pelanggan';
    }
}