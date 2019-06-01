<?php

namespace App\Http\Controllers\Mall;

use App\Models\ShopConfig;
use App\Models\WechatFollower;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use EasyWeChat\Foundation\Application;

class IndexController extends Controller {
    
    public function oauth() {
        session('wechat.oauth_user');
        return redirect()->to('mall');
    }

    public function index() {
        
        $app = app('wechat.official_account');
        $userApi = $app->user;

        $config = $app->jssdk->buildConfig(
            array(
                'onMenuShareQQ',
                'onMenuShareWeibo',
                'onMenuShareAppMessage',
                'onMenuShareTimeline',
            ),
            $debug = false,
            $beta = false,
            $json = true
        );
        
        $session = session()->get('wechat.oauth_user');
        $user = $session['default'];
        $openid = $user['id'];

        $user = $userApi->get($openid);

        $oldFollow = WechatFollower::where('openid', '=', $openid)->first();

        if ($oldFollow) {
            $follow['nickname'] = $user['nickname'];
            $follow['sex'] = $user['sex'] + 1;
            $follow['language'] = $user['language'];
            $follow['city'] = $user['city'];
            $follow['country'] = $user['country'];
            $follow['province'] = $user['province'];
            $follow['avatar'] = $user['headimgurl'];
            $follow['remark'] = $user['remark'];
            $follow['groupid'] = $user['groupid'];
            $follow['sub_status'] = 2;
            WechatFollower::where('openid', '=', $openid)->update($follow);
        } else {
            // 录入数据库
            $follow = new WechatFollower();
            $follow->openid = $openid;
            $follow->nickname = $user['nickname'];
            $follow->sex = $user['sex'] + 1;
            $follow->language = $user['language'];
            $follow->city = $user['city'];
            $follow->country = $user['country'];
            $follow->province = $user['province'];
            $follow->avatar = $user['headimgurl'];
            $follow->remark = $user['remark'];
            $follow->groupid = $user['groupid'];
            $follow->sub_status = 2;
            $follow->save();
        }

        $shopConfig = ShopConfig::first();

        if (empty($shopConfig)) {
            $shopConfig = new ShopConfig();
            $shopTitle = '欢迎来到vMall零售商城';
        }

        return view('mall.index')->with([
            'jsConfig' => $config,
            'shopConfig' => $shopConfig,
        ]);
    }
}
