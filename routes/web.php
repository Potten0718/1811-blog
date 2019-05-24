<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//www.blog.com目录
// Route::get('/', function () {
// 	session(['uid'=>111]);
//     return view('welcome',['name'=>'刘泓铄']);9656
// });

// Route::view('/','welcome',['name'=>'刘泓铄']);
//闭包
// Route::get('/', function () {
//     return view('goods');
// });
// Route::get('goods', function () {
//     return "你好！我是goods";
// });

//路由url请求
// Route::get('/goods','GoodsController@index');

//用post方式传 发送邮件
// Route::get('/from', function () {
//     return '<form action="sendemail" method=post>'.csrf_field().'<input type="text" name="email"><button>提交</button></form>';
// });
// Route::any('sendemail','BrandController@sendemail');

//手动Auth认证
Route::get('/test', function () {
    return '<form action="logindo" method=post>'.csrf_field().'<input type="text" name="email"><input type="password" name="password"><button>提交</button></form>';
});
Route::any('logindo','BrandController@logindo');
// Route::post('/from_do', function () {
// 	return request()->name;
// });
//get、post方式都行
// Route::match(['get','post'],'/from_do',function(){
// 	return request()->name;
// });
//不限制访问方式
// Route::any('/from_do',function(){
// 	return request()->name;
// });

//路由的传参
// Route::get('/goods/{id?}/{name}',function($id=0,$name){
// 	echo $id.'-'.$name;
// });

//路由的正则限制
// Route::get('/goods/{id?}/{name}',function($id=0,$name){
// 	return $id.'-'.$name;
// })->where(['id'=>'\d+','name'=>"['a-z']{6,}"]);

//重定向
// Route::get('/goods/{id}',function($id){
// 	return redirect('/goods');
// 	echo $id;
// });

//品牌
Route::prefix('/brand')->middleware('checkLogin')->group(function(){
	Route::get('add','BrandController@create');
	Route::get('list','BrandController@index');
	//起别名
	Route::post('add_do','BrandController@store')->name('doadd');
	// Route::post('add_do','BrandController@store');
	Route::get('edit/{id}','BrandController@edit');
	Route::get('del/{id}','BrandController@destroy');
});

//主体框架
Route::any('/adminn','admin\IndexController@index');

//管理员管理
Route::prefix('/admin')->group(function(){
	Route::get('add','admin\AdminController@create');
	Route::get('list','admin\AdminController@index');
	Route::post('add_do','admin\AdminController@store');
	Route::get('edit/{id}','admin\AdminController@edit');
	Route::get('del/{id}','admin\AdminController@destroy');
	Route::post('checkName','admin\AdminController@checkName');
});

//会员管理
Route::prefix('/user')->group(function(){
	Route::get('add','admin\UserController@create');
	Route::get('list','admin\UserController@index');
	Route::post('add_do','admin\UserController@store');
	Route::get('edit/{id}','admin\UserController@edit');
	Route::get('del/{id}','admin\UserController@destroy');
});

//分类管理
Route::prefix('/cate')->group(function(){
	Route::get('add','admin\CateController@create');
	Route::any('list','admin\CateController@index');
	Route::post('add_do','admin\CateController@store');
	Route::get('edit/{id}','admin\CateController@edit');
	Route::get('del/{id}','admin\CateController@destroy');
});

// 品牌管理
Route::prefix('/brand')->group(function(){
	Route::get('add','admin\BrandController@create');
	Route::get('list','admin\BrandController@index');
	//起别名
	Route::any('add_do','admin\BrandController@store')->name('doadd');
	// Route::post('add_do','admin\BrandController@store');
	Route::get('edit/{id}','admin\BrandController@edit');
	Route::get('del/{id}','admin\BrandController@destroy');
	Route::get('memcache','admin\BrandController@memcache');
});

//商品管理
Route::prefix('/goods')->group(function(){
	Route::get('add','admin\GoodsController@create');
	Route::get('list','admin\GoodsController@index');
	Route::post('add_do','admin\GoodsController@store');
	Route::get('edit','admin\GoodsController@edit');
	Route::get('del','admin\GoodsController@destroy');
});

//周四作业 商品
Route::prefix('/shangpin')->group(function(){
	Route::get('add','ShangpinController@create');
	Route::get('list','ShangpinController@index');
	Route::post('add_do','ShangpinController@store');
	Route::get('edit/{id}','ShangpinController@edit');
	Route::post('update/{id}','ShangpinController@update');
	Route::post('del/{shang_id}','ShangpinController@destroy');
	Route::get('xiangqing/{news_id}','ShangpinController@xiangqing');
});

//文章管理
Route::prefix('/news')->group(function(){
	Route::get('add','NewsController@create');
	Route::get('list','NewsController@index');
	//起别名
	Route::post('add_do','NewsController@store')->name('doadd');
	// Route::post('add_do','BrandController@store');
	Route::get('edit/{id}','NewsController@edit');
	Route::post('update/{id}','NewsController@update');
	Route::post('del/{news_id}','NewsController@destroy');
	Route::get('xiangqing/{news_id}','NewsController@xiangqing');
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//前台
Route::get('/','index\IndexController@index');
//登陆
Route::prefix('/login')->group(function(){
	Route::get('login','index\LoginController@login');
	Route::get('reg','index\LoginController@reg');
	Route::post('zhuce','index\LoginController@zhuce');
	// Route::post('add_do','BrandController@store');
	Route::post('email','index\LoginController@email');
	Route::post('store','index\LoginController@store');
	Route::post('denglu','index\LoginController@denglu');
});

//微商城页面
Route::prefix('index/goods')->group(function(){
    Route::get('/goodslist','index\GoodsController@goodslist');
    Route::get('/goodsinfo','index\GoodsController@goodsinfo');
    Route::get('/dogoods','index\GoodsController@dogoods');
    Route::get('/pinglun','index\GoodsController@pinglun');
});

Route::prefix('/user')->group(function(){
    Route::get('/userinfo','index\UserController@userinfo');
});

Route::prefix('index/order')->group(function(){
    Route::get('/index','index\orderController@index');
});

Route::prefix('index/address')->group(function(){
    Route::get('add','index\AddressController@add');
    Route::post('getArea','index\AddressController@getArea');
    Route::get('getAreaInfo/{id}','index\AddressController@getAreaInfo');
    Route::post('addressadd','index\AddressController@addressadd');
});


Route::prefix('index/cat')->group(function(){
    Route::get('/index','index\CatController@index');
    Route::get('/pay','index\CatController@pay');
    Route::get('/success','index\CatController@success');
    Route::post('/store','index\CatController@store');
    Route::get('/confirm/{id}','index\CatController@confirm');
});
