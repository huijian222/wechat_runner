<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 16/8/30
 * Time: 下午5:20
 */
namespace App\API;
class weather{

    public function getWeather($city){
        $ak = 'RPfUqaZaA2ZisUV3P8O19jtcw2dNOw8o';
        $city = rawurlencode($city);
        $url = 'http://api.map.baidu.com/telematics/v3/weather?location='.$city.'&output=json&ak='.$ak;
        //$url = 'http://api.map.baidu.com/telematics/v3/weather?location=%E6%9D%AD%E5%B7%9E&output=json&ak=RPfUqaZaA2ZisUV3P8O19jtcw2dNOw8o';
        $response = file_get_contents($url);
        $jsonArray = json_decode($response,true);
        $need = array(
            'PM2.5_today' =>  $jsonArray['results'][0]['pm25'],
            'temperature_today' => $jsonArray['results'][0]['weather_data'][0]['temperature'],
            'weather_today' => $jsonArray['results'][0]['weather_data'][0]['weather'],
            'weather_tomorrow' => $jsonArray['results'][0]['weather_data'][1]['weather'],
            'temperature_tomorrow' => $jsonArray['results'][0]['weather_data'][1]['temperature'],
        );
        return $need;
    }
}
