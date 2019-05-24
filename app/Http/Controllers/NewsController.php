<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreBrandPost;
use App\News;
use DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redis;


class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ncate = DB::table('ncate')->select()->get();
        // dd($ncate);
        $query = request()->all();
        $where = [];
        if ($query['news_name']??'') {
            $where[]=['news_name','like',"%$query[news_name]%"];
        }
        if (isset($query['ncate_id'])) {
            $where['ncate.ncate_id']=$query['ncate_id'];
        }
        $pageSize = config('app.pageSize');
        // dd($where);
        $data=DB::table('news')
            ->join('ncate','news.ncate_id','=','ncate.ncate_id')
            ->where($where)
            ->paginate($pageSize);
        $ncate= DB::table('ncate')->get();
        // dd($data);
        return view('news.list',['data'=>$data,'query'=>$query,'ncate'=>$ncate]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ncate = DB::table('ncate')->select()->get();
        return view('news.create',['ncate'=>$ncate]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=request()->except('_token');
        // dd($data);
        //文件上传
        if($request->hasfile('news_photo')){
        $res=$this->upload($request,'news_photo');
            if($res['code']){
                $data['news_photo']=$res['imgurl'];
            }
        }
        $res=News::create($data);
        // dd($res);
        if($res){
            //重定向
            return redirect('/news/list');
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
        $data=DB::table('news')->where('news_id',$id)->select()->first();
        $ncate=DB::table('ncate')->select('ncate_id','ncate_name')->get();
        // dd($ncate);
        return view('news.edit',['data'=>$data,'ncate'=>$ncate]);
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
        $data=$request->except('_token');
        // dd($data);
        $validator = \Validator::make($data, 
        [        
            //唯一性验证  
            'news_name'=>[
                'required',
                'max:10',
                Rule::unique('news')->ignore($id,'news_id'),
            ],   
            'news_zuozhe'=>'required',
            'news_email'=>'required',
            'news_gjz'=>'required',
            // 'news_photo'=>'required',
        ],[
            'news_name.required'=>'文章名不能为空！',
            'news_name.unique'=>'文章名字已经存在！',
            'news.name.max'=>'文章名字不能超过10！',
            'brand_zuozhe.required'=>'文章作者不能为空！',
            'brand_email.required'=>'文章email不能为空！',
            'brand_gjz.required'=>'文章关键字不能为空！',
            'brand_photo.required'=>'文章图片不能为空！',
        ]); 
 
        if ($validator->fails()) { 
            return redirect('news/edit/'.$id)->withErrors($validator)->withInput();                 
        } 

        // 文件上传
        if($request->hasfile('news_photo')){
            $res=$this->upload($request,'news_photo');
            if($res['code']){
                $data['news_photo']=$res['imgurl'];
            }
        }
        $res=News::where('news_id',$id)->update($data);
        if($res){
            return redirect('news/list');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $id=request()->news_id;
        // dd($news_id);
        $news=new News;
        $res=$news->where('news_id',$id)->delete();
        if($res){
            return ['code'=>1,'msg'=>'删除成功'];
        }else{
            return ['code'=>0,'img'=>'删除失败'];
        }
    }

    //详情
    public function xiangqing(Request $request,$id){
        $data=cache('news_'.$id);
        if(!$data){
            // 两表联查
            $data=DB::table('news')
            ->join('ncate','news.ncate_id','=','ncate.ncate_id')
            ->where('news_id',$id)
            ->get();
            cache(['news'=>$data],60);
        }

        if(Redis::exists('num')){
            $num=Redis::incr('num');
        }else{
            $num=Redis::set('num',1);
        }
        return view('news.xiangqing',['data'=>$data,'num'=>$num]);
    }

}


