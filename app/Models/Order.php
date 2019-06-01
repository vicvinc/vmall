<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

class Order extends BaseModel {

    protected $table = 'order';

    protected $guarded = [];

    public function details(){
        return $this->hasMany('App\Models\OrderGoods','order_uid','uid');
    }

    public function follower(){
        return $this->belongsTo('App\Models\WechatFollower', 'openid', 'openid');
    }

    public function getStatusAttribute($value) {
        $map = [
            'wait_pay'  => '待支付',
            'payed'     => '已支付',
            'refund'    => '已退款',
            'used'      => '已使用',
            'closed'    => '已关闭',
        ];

        return $map[$value];
    }

}
