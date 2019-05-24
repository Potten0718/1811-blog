<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $primarykey="admin_id";
    public $timestamps=true;
    const CREATED_AT='create_time';
    const UPDATED_AT='update_time';
    protected $table='admin';
    protected $fillable=[
    	'admin_name',
    	'admin_pwd',
    ];

}
