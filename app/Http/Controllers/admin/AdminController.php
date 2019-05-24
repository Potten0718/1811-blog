<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Admin;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data=Admin::all();
        return view('admin.admin.create',['data'=>$data]);
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
        $validateDate=request()->validate([
            'admin_name'=>'required|unique:admin|max:10',
            'admin_pwd'=>'required',
        ],[
            'admin_name.required'=>'管理员名不能为空',
            'admin_name.unique'=>'管理员名已经存在',
            'admin_name.max'=>'管理员名长度超长',
            'admin_pwd.required'=>'管理员密码不能为空',
        ]);
        $res=Admin::create($data);
        if($res){
            return redirect('admin/add');
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

    //管理员名唯一性验证
    public function checkName(){
        $admin_name=request()->admin_name;
        if($admin_name){
            $where['admin_name']=$admin_name;
        }
        $count=Admin::where($where)->count();
        return ['code'=>1,'count'=>$count];
    }
}
