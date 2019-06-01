<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;

use App\Models\BaseModel;

class Cart extends BaseModel {

    protected $table = 'cart';

    protected $guarded = [];

    public function goods() {
        return $this->hasOne('App\Models\Goods', 'uid', 'goods_uid');
    }

}
