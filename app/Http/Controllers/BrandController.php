<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests\StoreBrandPost;
use App\Brand;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{

    //手动Auth认证
    public function logindo(){
        $email=request()->email;
        $password=request()->password;
        // echo $email;
        // echo $password;
        if(Auth::attempt(['email'=>$email,'password'=>$password])){
            dump(Auth::email());
            dd(Auth::id());
        }else{
            return "登陆失败！";
        }
    } 

    //发送邮件
    public  function sendemail(){
        $email=request()->email;
        // dd($email);
        $this->sendMail($email);
    }

    public  function sendMail($email){
        \Mail::send('test',['name'=>$email],function($message)use($email){
            //设置主题
            $message->subject('这里是标题');
            //设置接收方
            $message->to($email);
        });
    }


    /**
     * Display a listing of the resource.
     *展示
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //session存储、删除、获取
        // $session=request()->session()->put(['name'=>'张三','age'=>12]);
        // $value=request()->session()->forget($session);
        // $value=request()->session()->all();
        // $value=request()->session()->get('name');
        // dd($value);
        
        //cookie获取、删除
        // Cookie::get('age');
        // Cookie::queue(Cookie::forget('age'));

        $query=request()->all();
        // dd($query);
        $where=[];
        if(isset($query['brand_name'])){
            $where[]=['brand_name','like',"%$query[brand_name]%"];
        }
        if(isset($query['brand_url'])){
            $where['brand_url']=$query['brand_url'];
        }
        $pagesize=config('app.pageSize');
        // DB::connection()->enableQueryLog();
        $data=Brand::where($where)->orderBy('brand_id','desc')->paginate($pagesize);
        // $logs = DB::getQueryLog();
        // dd($logs);
        return view('brand.list',['data'=>$data,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *添加
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Cookie::queue('age','123',1);
        return view('brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *执行添加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //验证方法2：
    // public function store(StoreBrandPost $request)
    public function store(Request $request)
    {
        $data=$request->except('_token');
        //验证方法1：
        $validatedData=$request->validate([
            'brand_name'=>'required|unique:brand|max:10',
            'brand_logo'=>'required',
            'brand_url'=>'required',
            'brand_desc'=>'required',
        ],[
            'brand_name.required'=>'商品名不能为空！',
            'brand_logo.required'=>'商品logo不能为空！',
            'brand_url.required'=>'商品网址不能为空！',
            'brand_desc.required'=>'商品详情不能为空！',
        ]);
        // dump($data);
        // $validator = \Validator::make($request->all(), 
        // [             
        //     'brand_name'=>'required|unique:brand|max:10',
        //     'brand_logo'=>'required',
        //     'brand_url'=>'required',
        //     'brand_desc'=>'required',
        // ],[
        //     'brand_name.required'=>'商品名不能为空！',
        //     'brand_logo.required'=>'商品logo不能为空！',
        //     'brand_url.required'=>'商品网址不能为空！',
        //     'brand_desc.required'=>'商品详情不能为空！',
        // ]); 
 
        // if ($validator->fails()) { 
        //     return redirect('post/create')->withErrors($validator)->withInput();                 
        // } 

        // 文件上传
        if($request->hasfile('brand_logo')){
            $res=$this->upload($request,'brand_logo');
            if($res['code']){
                $data['brand_logo']=$res['imgurl'];
            }
        }
        // dd($data);
        // $res=Brand::insert($data);
        $res=Brand::create($data);
        if($res){
            //重定向
            return redirect('/brand/list');
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
     *修改
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *执行修改
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
     *删除
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
