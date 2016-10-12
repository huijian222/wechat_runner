<?php

namespace App\Http\Controllers;
use App\API\weather;
use App\API\RunningInquire;
use Illuminate\Http\Request;
use Log;
use App\Http\Requests;

class WechatController extends Controller
{
    public function serve()
    {
        Log::info('request arrived.'); # 注意：Log 为 Laravel 组件，所以它记的日志去 Laravel 日志看，而不是 EasyWeChat 日志
        $wechat = app('wechat');
        $weather = new weather;
        $test = $weather->getWeather('富阳');
        $userApi = $wechat->user;
        $runner = new RunningInquire;
        $wechat->server->setMessageHandler(function ($message) use ($userApi , $test ,$runner) {
            switch ($message->MsgType) {
                case 'event':
                    # 事件消息...
                    break;
                case 'text':
                    if($message->Content == '天气'){
                        $weather = '今天'.$test['weather_today'].', 明天'.$test['weather_tomorrow'].'
    今天温度:'.$test['temperature_today'].' ,明日温度:'.$test['temperature_tomorrow'];
                        return $weather;
                    }
                    if($message->Content == '跑步'){
                        $runner->getView();
                        $weneed = $runner->getGrades();
                        $pe = $weneed[0].'同学,你好! 您的总次数为'.$weneed[5];
                        return $pe;
                    }
                    if($message->Content == 'test'){
                        $test_message = 'test_cuccess';
                        $wechat->serve->message($test_message)->send();
                    }
                    return '想要查看天气输入天气 , 其他暂未开放';
                    break;
                case 'image':
                    # 图片消息...
                    break;
                case 'voice':
                    return $message->Recognition;
                    # 语音消息...
                    break;
                case 'video':
                    # 视频消息...
                    break;
                case 'location':
                    # 坐标消息...
                    break;
                case 'link':
                    # 链接消息...
                    break;
                // ... 其它消息
                default:
                    # code...
                    break;
            }
        });

        Log::info('return response.');

        return $wechat->server->serve();
    }
}
