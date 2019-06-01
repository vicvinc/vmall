<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

class OrderGoods extends BaseModel {

    protected $table = 'order_goods';

    protected $guarded = [];

    public function order(){
        return $this->belongsTo('App\Models\Order', 'order_uid', 'uid');
    }

}
