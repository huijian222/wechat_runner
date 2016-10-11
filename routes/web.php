<?php


Route::get('/', function () {

    //dd($test);
    return view('welcome');
});

Route::post('/post_test' , function(){
    return 123;
});
Route::any('/deploy' , 'DeploymentController@hook');
Route::any('/wechat', 'WechatController@serve');

Route::get('test' , 'TestController@index');