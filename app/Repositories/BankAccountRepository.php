<?php   

namespace App\Repositories;

use App\Models\BankAccount;
use App\Repositories\Base\BaseRepository;

final class BankAccountRepository extends BaseRepository
{
    public function __construct(BankAccount $model) 
    {
        parent::__construct($model);
    }

    /**
     * Create Bank Account
     * 
     * @param array $validateData
     * @return PrimaryKey
     */
    public function create(array $validateData) 
    {
        return $this->model->create($validateData)->id;
    }
}