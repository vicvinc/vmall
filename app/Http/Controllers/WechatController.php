<?php

namespace App\Http\Controllers;

use EasyWeChat\Foundation\Application;
use EasyWeChat\Kernel\Messages\Text;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\WechatFollow;
use App\WechatMenu;
use Log;

/**
 * Class WechatController
 * @package App\Http\Controllers
 */
class WechatController extends Controller
{

    public function debug() {

    }

    public function serve() {

        $wechat = app('wechat.official_account');
        $server = $wechat->server;
        $userApi = $wechat->user;

        $server->push(function ($message) use ($userApi) {
            // 获取当前粉丝openId
            $openid = $message->FromUserName;
            $user = $userApi->get($openid);
            
            if ($message->MsgType == 'event') {
                switch ($message->Event) {
                    case'subscribe':
                        // 获取当前粉丝基本信息
                        // 判断当前粉丝是否以前关注过
                        $oldFollow = WechatFollow::where('openid', '=', $openid)->first();
                        if ($oldFollow) {
                            $follow['nickname'] = $user->nickname;
                            $follow['sex'] = ($user->sex + 1);
                            $follow['language'] = $user->language;
                            $follow['city'] = $user->city;
                            $follow['country'] = $user->country;
                            $follow['province'] = $user->province;
                            $follow['avatar'] = $user->avatar;
                            $follow['remark'] = $user->remark;
                            $follow['groupid'] = $user->groupid;
                            $follow['sub_status'] = 2;
                            WechatFollow::where('openid', '=', $openid)->update($follow);
                            $welcome = "欢迎回来，" . $user->nickname ."\n\n进入商城闲逛一会吧，\n\n<a href=\"http://imall.lovchun.com/mall#!/index\">点击进入</a>";
                            return $welcome;
                        } else {
                            // 录入数据库
                            $follow = new WechatFollow();
                            $follow->openid = $openid;
                            $follow->nickname = $user->nickname;
                            $follow->sex = ($user->sex + 1);
                            $follow->language = $user->language;
                            $follow->city = $user->city;
                            $follow->country = $user->country;
                            $follow->province = $user->province;
                            $follow->avatar = $user->avatar;
                            $follow->remark = $user->remark;
                            $follow->groupid = $user->groupid;
                            $follow->sub_status = 2;
                            $follow->save();
                            $welcome = "欢迎，" . $user->nickname ."\n\n进入商城闲逛一会吧，\n\n<a href=\"/mall#!/index\">点击进入</a>";
                            return $welcome;
                        }
                        break;
                    case 'unsubscribe':
                        WechatFollow::where('openid', '=', $openid)->update(['sub_status' => 1]);
                        break;
                    case 'text':
                    default:
                        return '你好，' . $user->nickname . ',\n欢迎关注我们，快去商城逛一逛吧';
                }
            } else {
                $user = $userApi->get($openid);
                $welcome = "欢迎，" . $user->nickname ."\n\n进入商城闲逛一会吧，\n\n<a href=\"/mall\">点击进入</a>";
                return $welcome;
            }
        });

        return $server->serve();
    }


}
