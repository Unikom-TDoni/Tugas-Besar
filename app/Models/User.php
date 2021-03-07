<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'admin';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
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
        $query = DB::table('users')->orderBy('name', 'asc');
        
        return $query;
    }

    public function getDetailData($id) 
    {
        $query = DB::table('users')->where("id", $id);

        return $query;
    }

    public function getDetailDataByUsername($username) 
    {
        $query = DB::table('users')->where("username", $username);

        return $query;
    }
}
