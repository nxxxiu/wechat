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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/phpinfo', function () {
    return view('phpinfo');
});

//微信
Route::get('/wechat/valid','WechatController@valid');//首次接入
Route::post('/wechat/valid','WechatController@wxEvent');//接收微信推送事件
Route::get('/wechat/accessToken','WechatController@accessToken');//获取微信accesstoken