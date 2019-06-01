<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;

use App\Models\BaseModel;

class Address extends BaseModel {
    protected $table = 'address';

    protected $guarded = [];

    public function follower() {
        return $this->belongsTo('App\Models\WechatFollower', 'openid', 'openid');
    }

}
