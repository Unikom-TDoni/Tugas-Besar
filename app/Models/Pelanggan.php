<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Pelanggan extends Authenticatable
{
    use HasFactory, Notifiable;
    
    protected $table = 'pelanggan';
    
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getListData() 
    {
        $query = DB::table('pelanggan')->orderBy('nama', 'asc');
        
        return $query;
    }

    public function getDetailData($telp) 
    {
        $query = DB::table('pelanggan')->where("telp", $telp);

        return $query;

    public function setPasswordAttribute($password)
    {   
        $this->attributes['password'] = Hash::make($password);
    }
}
