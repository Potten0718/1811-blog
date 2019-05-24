<?php

namespace App\Http\Controllers\index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class CatController extends Controller
{
    public function index()
    {
        // $u_id=session('u_id');
        // $data = DB::table('cart')->get();
        $data =  DB::table('goods')
        ->join('cat','cat.goods_id','=','goods.goods_id')
        ->get();
        return view('index.cat.index',['data'=>$data]);
    }

    public function pay()
    {
        return view('index.cat.pay');
    }

    public function success()
    {
        return view('index.cat.success');
    }
    public function store()
    {
        $data = [];
        $goods_id = request()->goods_id;
        $buy_number = request()->buy_number;
        
        // dd($data);
        // dd($data['goods_id']);
        $data['create_time']=time();
        $cartInfo = DB::table('cat')->select('goods_id','buy_number')->where('goods_id',$goods_id)->first();
        // dd($cartInfo);
        if (!empty($cartInfo)) {
            $cartInfo = json_decode(json_encode($cartInfo),true);
        }
        // dd($cartInfo);
        if (!empty($cartInfo)) {
            // echo 111;
            $res=$this->checkGoodsNumber($goods_id,$buy_number,$cartInfo['buy_number']);
            if($res){
                $updateInfo=[
                'buy_number'=>$cartInfo['buy_number']+$buy_number,
                'update_time'=>time()
                ];
                $result=DB::table('cat')->where('goods_id',$goods_id)->update($updateInfo);
                // dd($result);
                if ($result) {
                    return ['code'=>1,'content'=>'加入购物车成功'];
                }else{
                    return ['code'=>2,'content'=>'加入购物车失败'];
                }
            }
            // dd($data);
        }else{
            // dd(1111);
            $data ['goods_id']= $goods_id;
            $data ['buy_number' ]= $buy_number;
            $res = DB::table('cat')->insert($data);
            // dd($data);
            if ($res) {
                return ['code'=>1,'content'=>'加入购物车成功'];
            }else{
                return ['code'=>2,'content'=>'加入购物车失败'];
            }
        }
    

}
    public function checkGoodsNumber($goods_id,$buy_number,$number=0)
    {
        //根据商品ID查询商品库存
        $goods_number=DB::table('goods')->where("goods_id",$goods_id)->value("goods_num");
       // echo $goods_number;exit;
       if(($buy_number+$number)>$goods_number){
           return false;
       }else{
           return true;
       }
    }
    public function getTotal()
    {
    $goods_id = request()->goods_id;
    dd($goods_id);
    //获取商品价格
    $goodsWhere = [
        ['goods_id','=',$goods_id],
        ['is_show','=',1]
    ];
   $shop_price = $goods_model->where($goodsWhere)->value('shop_price');
    //获取购买数量
    if($this->checkLogin()){
        //从数据库中获取
        $cart_model = model('Cat');
        $user_id = $this->getUserId();
        $cartWhere = [
            ['user_id','=',$user_id],
            ['goods_id','=',$goods_id],
            ['is_del','=',1]
        ];
       $buy_number = $cart_model->where($cartWhere)->value('buy_number');
    }else{
        //从cookie中获取
        $str = cookie('cartInfo');
        if(!empty($str)){
            $info = getBase64Info($str);
            foreach($info as $k=>$v){
                if($goods_id==$v['goods_id']){
                    $buy_number = $v['buy_number'];
                }
            }
        }
    }
    echo $shop_price*$buy_number;
    }

    // //获取小计
    // public function getTotal(){
    //     $goods_id=input('post.goods_id',0,'intval');
    //     dd($goods_id);
    //     //获取商品价格
    //     // dump($goods_id);die;
    //     $goods_model=model('Goods');
    //     $goodsWhere=[
    //         ['goods_id','=',$goods_id],
    //         ['is_show','=',1]
    //     ];
    //     $goods_price=$goods_model->where($goodsWhere)->value('goods_price');
    //     // dump($goods_price);die;
    //     //获取购买数量
    //     if($this->checkLogin()){
    //         //从数据库中获取
    //         $cart_model=model('Cat');
    //         $user_id=$this->getUserId();
    //         $cartWhere=[
    //             ['goods_id','=',$goods_id],
    //             // ['user_id','=',$user_id],
    //             ['is_show','=',1]
    //         ];
    //         $buy_number=$cart_model->where($cartWhere)->value('buy_number');
    //     }else{
    //         //从cookie中获取
    //         $str=cookie('cartInfo');
    //         if(!empty($str)){
    //             $info=getBase64Info($str);
    //             foreach ($info as $k => $v) {
    //                 if($v['goods_id']==$goods_id){
    //                     $buy_number=$v['buy_number'];   
    //                 }
    //             }
    //         }
    //     }
    //     echo $goods_price*$buy_number;
    // }
    
     //提交订单
    public function confirm($id){
        $goods_id = explode(',',$id);
        $u_id = session('u_id');
        $where = [
            ['u_id','=',$u_id],
            ['is_del','=',1]
        ];
        $cartInfo = DB::table('cart')
                    ->join('goods','cart.goods_id','=','goods.goods_id')
                    ->where($where)
                    ->whereIn('goods.goods_id',$goods_id)
                    ->select('cart.goods_id','shop_price','goods_img','buy_number','goods_name','goods_number','create_time')
                    ->get();
        // dd($cartInfo);
        //总价
        $count = 0;
        foreach($cartInfo as $k=>$v){
            $count += $v->buy_number*$v->shop_price;
        }
        // dd($count);

        //查询收货地址
        $addressWhere = [
            ['u_id','=',$u_id],
            ['is_del','=',1],
        ];
        $info = DB::table('address')->where($addressWhere)->get();
        foreach($info as $k=>$v){
            $info[$k]->province = DB::table('area')->where('id',$v->province)->select('name')->first();
            $info[$k]->city = DB::table('area')->where('id',$v->city)->select('name')->first();
            $info[$k]->area = DB::table('area')->where('id',$v->area)->select('name')->first();
        }
        // dd($info);
        return view('index/cat/confirm',['cartInfo'=>$cartInfo,'count'=>$count,'info'=>$info]);
    }


}
