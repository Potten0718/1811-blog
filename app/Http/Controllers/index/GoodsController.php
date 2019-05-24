<?php

namespace App\Http\Controllers\index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class GoodsController extends Controller
{
    public function goodslist()
    {
        // $brandd_id=request()->input();
        // dd($brandd_id);
        $data=Db::table('goods')->get();
        return view('index.goods.goodslist',['data'=>$data]);
    }

    public function dogoods()
    {
        $goods=Db::table('goods')->get();
        return view('index.goods.goodslist',['goods'=>$goods]);
    }

    // public function goodsinfo()
    // {
    //     $goods_id=\request()->input();
    //     $data=Db::table('goods')->where('goods_id',$goods_id)->get();
    //     $ping=\request()->all();
    //     // dd($ping);
    //     $res=DB::table('pinglun')->insert($ping);
    //     return view('index.goods.goodsinfo',['data'=>$data,'ping'=>$ping]);
    // }
    
    public function goodsinfo()
        {
            $goods_id=\request()->goods_id;
            //cache(['goods_id'=>''],0);
            $data = cache('goods_'.$goods_id);

           // dd($data);
            if(!$data){
                echo 11;
                $data=Db::table('goods')->where('goods_id',$goods_id)->first();

                cache(['goods_'. $goods_id=>$data],12*60);

            }
            //dd($data);
            $pagesize=config('app.pageSize');
            $res=Db::table('pinglun')->orderby('create_time','desc')->paginate($pagesize);
            return view('index.goods.goodsinfo',['data'=>$data,'res'=>$res,'goods_id'=>$goods_id]);
        }

    public function goodsDetail($cate_id)
    {
        $res=$this->getCateInfo($cate_id);
        // dd($res);                                                                                                                                                       
        // $result=DB::table('')
        $pageSize=config('app.pageSize');
        $data=DB::table('goods')->whereIn('cate_id',$res)->paginate(4);
        // dd($data);
        return view('goods/goodsdetail',['data'=>$data]);
    }

    public function getCateInfo($cate_id)
    {


        $info=DB::table('cate')->get();
        $data=$this->getCateId($info,$cate_id);
        return $data;
        // dd($data);
    }

    public function getCateId($info,$parent_id)
    {
        static $id=[];
        foreach($info as $k=>$v){
            if($v->parent_id==$parent_id){
                $id[]=$v->cate_id;
                $this->getCateId($info,$v->cate_id);
            }
        }
        return $id;
    }

    //评论
    public function pinglun()
    {
        $data=\request()->all();
        $res=DB::table('pinglun')->insert($data);
        if($res){
            return ['code'=>1,'msg'=>'添加成功'];
        }else{
            return ['code'=>2,'msg'=>'添加失败'];
        }
    }
}
