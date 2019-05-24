<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
    protected $primarkeys="cate_id";
    public $timestamps=true;
    const CREATED_AT="create_time";
    const UPDATED_AT="update_time";
  	protected $table="cate";
  	protected $fillable=[
  		'cate_name',
  		'cate_show',
  		'is_show',
  		'cate_pid',
  	];
}
