<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

class WechatFollower extends BaseModel {

    protected $table = 'wechat_follower';

    protected $guarded = [];

    public function addresses(){
        return $this->hasMany('App\Models\Address', 'openid', 'openid');
    }

    public function getSexAttribute($value) {
        $map = [
            'unknow' => '未知',
            'male' => '男',
            'female' => '女',
        ];

        return $map[$value];
    }

    public function getSubStatusAttribute($value) {
        $map = [
            'subscribed' => '已关注',
            'unsubscribe' => '未关注',
        ];

        return $map[$value];
    }

}
