<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
Route::rule('admin/caches','admin/TestController/caches');
Route::rule('admin/getcaches','admin/TestController/getcaches');
Route::group(['name'=>'cate','prefix'=>'admin/CatesController/'],function(){
	Route::rule('create/[:id]','create');
	Route::rule('save','save');
	Route::rule('index/[:id]','index');
	Route::rule('del/:id','delete');
	Route::rule('edit/:id','edit');
	Route::rule('update/:id','update');

})->after(['app\admin\behavior\CheckAuth']);

Route::group(['name'=>'good','prefix'=>'admin/GoodsController/'],function(){
	Route::rule('create','create');
	Route::rule('save','save');
	Route::rule('index','index');	
	Route::rule('del/:id','delete');
	Route::rule('edit/:id','edit');
	Route::rule('update/:id','update');
	Route::rule('upstatus/:id','upstatus');
	Route::rule('downstatus/:id','downstatus');
})->after(['app\admin\behavior\CheckAuth']);
Route::group(['name'=>'admin','prefix'=>'admin/LoginController/'],function(){
	Route::rule('login','index');
	Route::rule('code','mkcode');
	Route::rule('dologin','dologin');
	Route::rule('logout','logout');

});
Route::group(['name'=>'order','prefix'=>'admin/OrdersController/'],function(){
	Route::rule('index','index');
	Route::rule('edit/:id','edit');
	Route::rule('update/:id','update');
	Route::rule('read/:id','read');
	Route::rule('del/:id','delete');
})->after(['app\admin\behavior\CheckAuth']);


Route::group([],function(){
Route::rule('/user-create','admin/UsersController/create');
Route::rule('/user-save','admin/UsersController/save');
Route::rule('/user-index','admin/UsersController/index');
Route::rule('/user-del/:id','admin/UsersController/delete');
Route::rule('/user-edit/:id','admin/UsersController/edit');
Route::rule('/user-update/:id','admin/UsersController/update');
})->after(['app\admin\behavior\CheckAuth']);

Route::rule('/','home/FirstController/index');
Route::rule('/home/list/[:id]','home/FirstController/list');
Route::rule('/home/read/:id','home/FirstController/read');
Route::rule('/cart/index/:id','home/CartController/index');

Route::group([],function(){

Route::rule('/cart/save','home/CartController/save');
Route::rule('/cart/del/:id','home/CartController/delete');
Route::rule('/cart/add/:id','home/CartController/add');
Route::rule('/cart/sub/:id','home/CartController/sub');
Route::rule('/order/getinfo','home/OrdersController/getinfo');
Route::rule('/order/save','home/OrdersController/save');
Route::rule('/order/finish','home/OrdersController/finish');
Route::rule('/order/myorder','home/OrdersController/myorder');
Route::rule('/home/myjd','home/FirstController/myjd');
Route::rule('/myjd/save','home/FirstController/save');
})->after(['app\home\behavior\CheckAuth']);


Route::rule('/home/login','home/LoginController/login');
Route::rule('/home/dologin','home/LoginController/dologin');
Route::rule('/home/logout','home/LoginController/logout');
Route::rule('/home/register','home/LoginController/register');
Route::rule('/home/save','home/LoginController/save');
Route::rule('/admin/js1','admin/JavascriptController/js1');
Route::rule('/admin/ajax/:id','admin/JavascriptController/ajax');
Route::rule('/admin/js2','admin/JavascriptController/js2');
Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});

Route::get('hello/:name', 'index/hello');

return [

];
