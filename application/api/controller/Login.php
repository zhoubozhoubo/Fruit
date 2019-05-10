<?php

namespace app\api\controller;

use app\model\User;
use app\util\ReturnCode;
use think\Config;

/**
 * 用户登录
 */
class Login extends Base
{

    public function index()
    {
        $this->requestType('POST');
        $appid = Config::get("wechat.appid");
        $secret = config::get("wechat.secret");
        $url = config::get("wechat.url");
        $js_code = $this->request->post()['code'];

        $url = "{$url}?appid={$appid}&secret={$secret}&js_code={$js_code}&grant_type=authorization_code";

        //初始化
        $ch = curl_init();
        //curl配置
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //不做证书校验，部署在linux下请改为true
        //curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        //执行句柄，获取结果内容
        $file_contents = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        //释放句柄
        curl_close($ch);

        //生成3rd_session登录态
        $session3rd = $this->_3rd_session(16);

        //解析openid,session_key,存入session
        cache($session3rd, json_decode($file_contents, true));

        //组装数据,返回session3rd给用户端
        $data = [
            'third_Session' => $session3rd
        ];

        return $this->buildSuccess($data);
    }

    /**
     * 生成3rd_session登录态
     */
    public function _3rd_session($len)
    {
        // linux下产生随机数
        $fp = @fopen('/dev/urandom', 'rb');
        $result = '';
        if ($fp !== FALSE) {
            $result .= @fread($fp, $len);
            @fclose($fp);
        } else {
            trigger_error('Can not open /dev/urandom.');
        }
        // convert from binary to string
        $result = base64_encode($result);
        // remove none url chars
        $result = strtr($result, '+/', '-_');
        return substr($result, 0, $len);

        // 另外方法
        /*$chars = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h',
            'i', 'j', 'k', 'l','m', 'n', 'o', 'p', 'q', 'r', 's',
            't', 'u', 'v', 'w', 'x', 'y','z', 'A', 'B', 'C', 'D',
            'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L','M', 'N', 'O',
            'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y','Z',
            '0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
        // 在 $chars 中随机取 $length 个数组元素键名
        $keys = array_rand($chars, $len);
        $res = '';
        for($i = 0; $i < $len; $i++)
        {
            // 将 $len 个数组元素连接成字符串
            $res .= $chars[$keys[$i]];
        }

        return $res;*/
    }

    /**
     * 检测用户账号是否存在并检测账号信息是否完整
     */
    public function check()
    {
        $this->requestType('POST');
        $postData = $this->request->post();
        //根据third_Session识别用户身份
        $session3rd = $postData['third_Session'];
        $openid = cache($session3rd)['openid'];
        //根据openid查找用户
        $user=User::get(['openid'=>$openid]);
        if($user){
            //检测账号信息
            if(!$user['name'] || !$user['phone']){
                return $this->buildFailed(ReturnCode::INVALID,'账号信息不完整');
            }
            return $this->buildSuccess($user);
        }else{
            return $this->buildFailed(ReturnCode::RECORD_NOT_FOUND,'记录未找到');
        }
    }

    /**
     * 用户完善账号信息
     */
    public function perfect() {
        $this->requestType('POST');
        $postData = $this->request->post();
        //根据third_Session识别用户身份
        $session3rd = $postData['third_Session'];
        $openid = cache($session3rd)['openid'];
        //根据openid查找用户
        $user=User::get(['openid'=>$openid]);
        $data=[
            'name'=>$postData['name'],
            'phone'=>$postData['phone'],
            'nickname'=>$postData['nickName'],
            'avatarurl'=>$postData['avatarUrl'],
            'openid'=>$openid,
        ];
        if(!$user){
            //用户不存在
            $res=User::create($data);
            if($res){
                return $this->buildSuccess($res);
            }else{
                return $this->buildFailed(ReturnCode::ADD_FAILED,'添加记录失败');
            }
        }else{
            //用户存在
            $res=User::update($data,['openid'=>$openid]);
            if($res){
                return $this->buildSuccess($res);
            }else{
                return $this->buildFailed(ReturnCode::UPDATE_FAILED,'更新记录失败');
            }
        }
    }
}
