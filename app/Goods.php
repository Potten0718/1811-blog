<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    protected $primarykey="goods_id";
    public $timestamps=false;
    const CREATED_AT='create_time';
    const UPDATED_AT='update_time';
    protected $table='goods';
    protected $fillable=[
    	'goods_name',
    ];
}
