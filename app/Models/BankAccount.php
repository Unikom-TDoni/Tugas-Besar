<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    protected $table = 'bank_account';

    public function transaksi() 
    {
        $this->model->hasOne(Transaksi::class);
    }

    protected $fillable = [
        'nama_rekening', 'nomor_rekening', 'nama_bank'
    ];
}