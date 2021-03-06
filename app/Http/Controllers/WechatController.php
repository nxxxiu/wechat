<?php
namespace App\Http\Controllers;
use App\wxUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
class WechatController extends Controller
{
    //首次接入
    public function valid()
    {
        echo $_GET['echostr'];
    }

    //接受微信推送事件
    public function wxEvent()
    {
        $xml_str=file_get_contents("php://input");
        $log_str='>>>>>>'.date('Y-m-d H:i:s').$xml_str."\n";
        is_dir('logs') or mkdir('logs', 0777, true);
        file_put_contents('logs/wx_event.log',$log_str,FILE_APPEND);
    }

    public function accessToken()
    {
        //先获取缓存，如果不存在请求接口
        $redis_key='wx_access_token';
        $token=Redis::get($redis_key);
        if (!$token){
            $url='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' . env('APPID') . '&secret=' . env('APPSECRET');
//        echo $url;die;
            $json_str=file_get_contents($url);
//        print_r($json_str);die;
            $arr=json_decode($json_str,true);
            print_r($arr);
            $redis_key='wx_access_token';
            Redis::set($redis_key,$arr['access_token']);
            Redis::expire($redis_key,3600);
        }
        return $token;
    }

}
