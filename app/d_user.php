<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;
use DB;

class d_user extends Authenticatable
{
    protected $table       = 'd_user';
    protected $primaryKey  = 'u_id';
    public $incrementing   = false;
    public $remember_token = false;
    protected $hidden = [
        'password', 'remember_token',
    ];
    const CREATED_AT       = 'u_create_at';
    const UPDATED_AT       = 'u_update_at';

    protected $fillable = ['u_id','u_name','u_email','u_level', 'u_code' ,'u_username', 'password', 'u_user', 'u_lastlogin', 'u_lastlogout','status_data'];
}
