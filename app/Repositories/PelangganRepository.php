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

    public function insert($attribute) 
    {
        $this->model->create($attribute);
    }

    public function getProfile($id) 
    {
        return $this->model->findOrFail($id, ['id','nama', 'jenis_kelamin', 'tanggal_lahir', 'telp', 'alamat', 'gambar']);
    }

    public  function updateProfile($id, array $validatedData)
    {  
        $this->model->findOrFail($id)->update($validatedData);
    }
}