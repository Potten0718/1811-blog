<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $primarykey="news_id";
    public $timestamps=true;
    const CREATED_AT='create_time';
    const UPDATED_AT='update_time';
    protected $table='news';
    protected $fillable=[
    	'news_name',
    	'news_cate',
    	'news_zuozhe',
    	'news_email',
    	'news_photo',
    	'news_gjz',
        'news_zyx',
    	'news_show',
    	'news_content',
    	'ncate_id',
    ];
}
