<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $primarykey="brand_id";
    public $timestamps=true;
    const CREATED_AT='create_time';
    const UPDATED_AT='update_time';
    protected $table='brand';
    protected $fillable=[
    	'brand_name',
    	'brand_url',
        'brand_logo',
    	'brand_show',
    	'brand_desc',
    ];
}
