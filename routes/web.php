<?php


Route::get('/', function () {

    //dd($test);
    return view('welcome');
});
Route::any('/deploy' , 'DeploymentController@hook');
Route::any('/wechat', 'WechatController@serve');