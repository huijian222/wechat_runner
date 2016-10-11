<?php
namespace App\API;
use Illuminate\Http\Request;

use App\Http\Requests;
class RunningInquire{
    public function getView(){
        $username = 2015112216;
        $password = 2015112216;
        $cookie = dirname(__FILE__) . '/cookie_oschina.txt';
        $url = "http://hzaspt.sunnysport.org.cn/login";
        $user_agent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.2; .NET CLR 1.1.4322)";
        $httpheader=array(
            'Content-type'=>'application/x-www-form-urlencoded',
        );
        $curl = curl_init();//初始化curl模块
        curl_setopt($curl, CURLOPT_URL, $url);//登录提交的地址
        curl_setopt($curl, CURLOPT_HEADER, 0);//是否显示头信息
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 0);//是否自动显示返回的信息
        curl_setopt($curl, CURLOPT_HTTPHEADER, $httpheader);
        curl_setopt($curl, CURLOPT_POSTFIELDS, 'username='.$username.'&password='.$password);
        curl_setopt ($curl, CURLOPT_AUTOREFERER, 1 ); // 自动设置Referer
        curl_setopt ($curl, CURLOPT_USERAGENT, $user_agent); // 模拟用户使用的浏览器
        curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie); //设置Cookie信息保存在指定的文件中
        curl_setopt($curl, CURLOPT_POST, 1);//post方式提交
        $return = curl_exec($curl);
        curl_close($curl);//关闭cURL资源，并且释放系统资源
    }
    public function getGrades(){
        $cookie = dirname(__FILE__) . '/cookie_oschina.txt';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'http://hzaspt.sunnysport.org.cn/runner/');
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_COOKIEFILE, $cookie); //读取cookie
        $rs = curl_exec($curl); //执行cURL抓取页面内容
        curl_close($curl);
        preg_match_all("/<td>(.*?)<\/td>/", $rs, $match1);
        //preg_match_all("/<label>(.*?)<\/label>/" , $match1 , $output1);
        preg_match_all("/<label>(.*?)<\/label>/", $rs, $match2);
        //dd($match1);
        $return = array(
            $match2[1][1], //姓名
            $match2[1][3], //性别
            $match1[1][1], //总里程
            $match1[1][3], //平均速度
            $match1[1][5], //有效次数
            $match1[1][17] //总次数
        );
        return $return;
    }
}
