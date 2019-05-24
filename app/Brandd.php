<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brandd extends Model
{
    protected $primarykey="brandd_id";
    public $timestamps=false;
    const CREATED_AT='create_time';
    const UPDATED_AT='update_time';
    protected $table='brandd';
    protected $fillable=[
    	'brandd_name',
    	'brandd_url',
        'brandd_logo',
    	'brandd_show',
    	'brandd_desc',
    ];
}
