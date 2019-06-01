<?php

namespace App\Models;
// use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

class WechatMenu extends BaseModel {

    protected $table = 'wechat_menu';

    protected $guarded = [];

    public function getTypeAttribute($value) {
        $map = [
            'view' => '跳转链接',
            'click' => '点击事件',
            'none' => '无',
        ];

        return $map[$value];
    }
    
}
