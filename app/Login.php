<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    protected $primarykey="l_id";
    public $timestamps=true;
    const CREATED_AT='create_time';
    const UPDATED_AT='update_time';
    protected $table='login';
    protected $fillable=[
    	'l_tel',
    	'l_pwd',
    ];
}
