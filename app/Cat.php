<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    protected $primarykey="cat_id";
    public $timestamps=true;
    const CREATED_AT='create_time';
    const UPDATED_AT='update_time';
    protected $table='cat';
}
