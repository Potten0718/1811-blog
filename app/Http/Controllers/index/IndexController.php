<?php

namespace App\Http\Controllers\index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class IndexController extends Controller
{
    public function index()
    {
        $data=Db::table('goods')->get();
        $brand=Db::table('brandd')->get();
        return view('index.index.index',['data'=>$data],['brand'=>$brand]);
    }


}
