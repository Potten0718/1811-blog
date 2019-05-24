<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBrandPost;
use App\Brandd;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brandd_name=request()->brandd_name;
        // dd($brandd_name);
        $where=[];
        if($brandd_name){
            $where[]=['brandd_name','like',"%$brandd_name%"];
        }
        // $pagesize=config('app.pagesize');
        $data=Brandd::where($where)->paginate(2);
        return view('admin.brand.list',['data'=>$data]);
    }


    //测试memcache
    public  function memcache(){
        // cache(['name'=>'Potten'],1);
        // dd(cache('name'));
        $data=Brandd::all();
        // dd($data);
        dd(cache(['data'=>$data],0));
        dd(cache('data'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $data=$request->except('_token');
        // dd($data);
        // 第一种验证
        $validateDate=$request->validate([
            'brandd_name'=>'required|unique:brandd|max:10',
            'brandd_url'=>'required',
            'brandd_logo'=>'required',
            'brandd_desc'=>'required',
        ],[
            'brandd_name.required'=>'品牌名称不能为空',
            'brandd_name.unique'=>'品牌名称已经存在',
            'brandd_name.max'=>'品牌名称不能超过10个字符',
            'brandd_url.required'=>'品牌网址不能为空',
            'brandd_logo.required'=>'品牌LOGO不能为空',
            'brandd_desc.required'=>'品牌排序不能为空',
        ]);
        //第三种验证
        // $validator = \Validator::make($request->all(), 
        // [             
        //     'brandd_name'=>'required|unique:brand|max:10',
        //     'brandd_logo'=>'required',
        //     'brandd_url'=>'required',
        //     'brandd_desc'=>'required',
        // ],[
        //     'brandd_name.required'=>'商品名不能为空！',
        //     'brandd_logo.required'=>'商品logo不能为空！',
        //     'brandd_url.required'=>'商品网址不能为空！',
        //     'brandd_desc.required'=>'商品详情不能为空！',
        // ]); 
 
        // if ($validator->fails()) { 
        //     return redirect('post/create')->withErrors($validator)->withInput();                 
        // } 
        //上传图片
        // dd($request->hasfile('brandd_logo'));
        if($request->hasfile('brandd_logo')){
            $res=$this->upload($request,'brandd_logo');
            if($res['code']){
                $data['brandd_logo']=$res['imgurl'];
            }
        }
        $res=Brandd::create($data);
        if($res){
            return redirect('/brand/list');
        } 
    }

    //上传的方法
    public function upload(Request $request,$file){
        // echo 123;
        if($request->file($file)->isValid()){
            $photo=$request->file($file);
            $store_result=$photo->store(date('Ymd'));
            // dd($store_result);
            return ['code'=>1,'imgurl'=>$store_result];
        }else{
            return ['code'=>2,'message'=>'上传过程中出现错误'];
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
