<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Cate;

class CateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Cate::paginate(5);
        return view('admin.cate.list',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //查询数据
        $info=Cate::all();
        //调用无限极分类函数
        $cate=$this->getCateInfo($info);
        // dd($cate)
        return view('admin.cate.create',['cate'=>$cate]);
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
        // dd($data);
        $res=Cate::create($data);
        if($res){
            return redirect('/cate/list');
        }
    }

    //无限极分类函数
    public function getCateInfo($data,$cate_pid=0){
      //用于存储整理后的数据
        static $arr=[];
        //遍历整个数组
        foreach($data as $k=>$v){
            if($v['cate_pid']==$cate_pid){
                $arr[]=$v;
                $this->getCateInfo($data,$v['cate_id']);
                    }
               }
        // dd($arr);
        return $arr;
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
