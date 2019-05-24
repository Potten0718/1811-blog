<?php

namespace App\Http\Controllers\index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Login;

class LoginController extends Controller
{
    public function login(){
    	return view('index.login.login');
    }

    public  function reg(){
    	return view('index.login.reg');
    } 

    //短信注册
    public  function zhuce(){
    	$l_tel=request()->l_tel;
    	// dd($l_tel);
    	$code=rand('100000','999999');
    	//$message="欢迎注册铄珠宝有限公司,您的验证码是【".$code."】";
    	$res = $this->sendSms($l_tel,$code); 	
  		return $res;
    }

    //发送短信
    public function sendSms($l_tel,$code){
    	Cookie::queue('l_tel',$code,3);
    	$host = "http://yzxtz.market.alicloudapi.com";
	    $path = "/yzx/notifySms";
	    $method = "POST";
	    $appcode = "aa6c8313544745f6a9fe21a14a129b9d";
	    $headers = array();
	    array_push($headers, "Authorization:APPCODE " . $appcode);

	    $querys = "phone=".$l_tel."&templateId=TP18040316&variable=num%3A".$code."%2Cmoney%3A888";
	    // dd($querys);
	   // $querys = "phone=$l_tel&templateId=TP18040316&variable=num%3A1234%2Cmoney%3A$message";
	    $bodys = "";
	    $url = $host . $path . "?" . $querys;
//dd($url);
	    $curl = curl_init();
	    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
	    curl_setopt($curl, CURLOPT_URL, $url);
	    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
	    curl_setopt($curl, CURLOPT_FAILONERROR, false);
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($curl, CURLOPT_HEADER, false);
	    if (1 == strpos("$".$host, "https://"))
	    {
	        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	    }
	    $data = curl_exec($curl);
	    curl_close($curl);
	    return $data;
	}

	//email注册
	public function email(){
		$email=request()->l_tel;
		// dd($email);
		$this->sand($email);
		// return $msg;
	}

	//发送邮箱
    public function sand($email)
    {
        \Mail::send('test',['name'=>$email],function($message)use($email){
            $message->subject('铄珠宝email的注册码是');
            $message->to($email);
        });
    }

    //执行注册(入库)
    public function store(){
		$data=request()->all();
		$res=Login::create($data);
    }

    //执行登陆
    public function denglu(){
    	$l_tel=request()->l_tel;
    	$l_pwd=request()->l_pwd;
    	// dd($l_tel);
    	$where[]=['l_tel','=',$l_tel];
    	$where[]=['l_pwd','=',$l_pwd];
    	$res=Login::where($where)->count();
    	if($res){
            session(['userInfo'=>$l_tel]);
    		return 1;
    	}else{
    		return 2;
    	}
    }
}
