<?php
namespace App\API;

class RunningInquire{
    function login_post($url, $cookie, $post) {
        $curl = curl_init();//初始化curl模块
        curl_setopt($curl, CURLOPT_URL, $url);//登录提交的地址
        curl_setopt($curl, CURLOPT_HEADER, 0);//是否显示头信息
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 0);//是否自动显示返回的信息
        curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie); //设置Cookie信息保存在指定的文件中
        curl_setopt($curl, CURLOPT_POST, 1);//post方式提交
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post));//要提交的信息
        curl_exec($curl);//执行cURL
        curl_close($curl);//关闭cURL资源，并且释放系统资源
    }

    public function getView(){
        $res;
        $url = 'http://220.168.44.238/default2.aspx';
        $result = $this->curl_request($url);
        $pattern = '/<input type="hidden" name="__VIEWSTATE" value="(.*?)" \/>/is';
        preg_match_all($pattern, $result, $matches);
        $res[0] = $matches[1][0];
        $pattern = '/<input type="hidden" name="__VIEWSTATEGENERATOR" value="(.*?)" \/>/is';
        preg_match_all($pattern, $result, $matches);
        $res[1] = $matches[1][0];
        return $res;
    }
}
