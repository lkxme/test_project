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

/*return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],

];
*/

use think\Route;
Route::get('/','admin/index/index');

Route::get('top','admin/index/top');
Route::get('left','admin/index/left');
Route::get('main','admin/index/main');


//定义后台登录界面
Route::post( 'login','admin/public/login');
Route::get( 'login','admin/public/login');
Route::get( 'logout','admin/public/logout');

//定义分类添加路由
Route::group('admin',function(){
    Route::get('category/ajaxdel','admin/category/ajaxdel');
    Route::get('category/add','admin/category/add');
    Route::post('category/add','admin/category/add');
    Route::get('category/index','admin/category/index');
    Route::get('category/upd','admin/category/upd');
    Route::post('category/upd','admin/category/upd');
});

//定义文章列表路由
Route::group('admin',function(){
    Route::post('article/upd','admin/article/upd');
    Route::get('article/upd','admin/article/upd');
    Route::get('article/index','admin/article/index');
    Route::get('article/add','admin/article/add');
    Route::post('article/add','admin/article/add');
});



//test测试
// Route::get( 'test','admin/test/test');
// Route::get( 'test1','admin/test/test2');