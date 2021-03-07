<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BankAccount extends Model
{
    protected $table = 'bank_account';

    protected $fillable = [
        'nama_rekening', 'nomor_rekening', 'nama_bank'
    ];

    public function transaksi() 
    {
        $this->model->hasOne(Transaksi::class);
    }

    public function getNextId() 
    {
        $statement = DB::select("show table status like 'bank_account'");

        return $statement[0]->Auto_increment;
    }
}