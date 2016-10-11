<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class TestController extends Controller
{
    public function index(){
        return $this->getView();
    }

    public function getView(){
//        $ch = curl_init();
//        $post_data = array(
//            'Host'=>'hzaspt.sunnysport.org.cn',
//            'Content-Type'=>'application/x-www-form-urlencoded',
//            'Cache-Control'=>'no-cache',
//            'username=2015112216&password=2015112216'
//        );
//        curl_setopt($ch, CURLOPT_URL, "http://hzaspt.sunnysport.org.cn/login");
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
//        curl_setopt($ch, CURLOPT_POST, 1);
//        $output = curl_exec($ch);
//        //$output = iconv('GB2312', 'UTF-8', $output);
//        curl_close($ch);
//        //dd($output);
//        print_r($output);
//        //return 123;
//        return $output;
        $ch = curl_init ();
        $data = array (
        );
        $uri = "http://hzaspt.sunnysport.org.cn/login";
        curl_setopt ( $ch, CURLOPT_URL, $uri );
        curl_setopt ( $ch, CURLOPT_POST, 1 );
        curl_setopt ( $ch, CURLOPT_HEADER, 0 );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data );
        $return = curl_exec ( $ch );
        curl_close ( $ch );

        print_r($return);
        return $return;
    }
}
