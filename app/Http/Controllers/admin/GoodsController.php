<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Cate;
use App\Brandd;
use App\goods;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Goods::all();
        return view('admin.goods.list',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //获取分类信息
        $info=Cate::get();
       // dd($info);
        // $info= DB::table('cate')->where('cate_id')->get();
        // dd($info);
        $cate=$this->getCateInfo($info);
        // dd($cate);
        //获取品牌信息
        // $brandd=Brandd::select();
        $brandd= DB::table('brandd')->select()->get();
        // dd($brandd);
        return view('admin.goods.create',['cate'=>$cate,'brandd'=>$brandd]);
    }

    //无限极分类函数
    public function getCateInfo($data,$cate_pid=0){
        static $arr=[];
        foreach($data as $k=>$v){
            if($v['cate_pid']==$cate_pid){
                $arr[]=$v;
                $this->getCateInfo($data,$v['cate_id']);
            }
        }
        return $arr;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->except('_token');
        // 文件上传
        if($request->hasfile('goods_logo')){
            $res=$this->upload($request,'goods_logo');
            if($res['code']){
                $data['goods_logo']=$res['imgurl'];
            }
        }
       $res=Goods::create($data);
       dd($res);
        if($res){
            //重定向
            return redirect('/goods/list');
        }
    }

    //文件上传方法
    public function upload(Request $request,$file){
        if($request->file($file)->isValid()){
            $photo=$request->file($file);
            $store_result=$photo->store(date('Ymd'));
            // $store_result=$photo->storeAs($file,'test.jpg');
            return ['code'=>1,'imgurl'=>$store_result];
        }else{
            return ['code'=>0,'message'=>'上传过程中出错'];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
