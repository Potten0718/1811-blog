<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShangpinController extends Controller
{
   //展示
   public function index(){

   }

   //添加
   public function create(){
   	return view('shangpin.create');
   }

   //执行商品添加
   public function store(Request $request){
   		$data=$request->except('_token');
   		dd($data);
   }	

}
