<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

class Goods extends BaseModel {

    protected $table = 'goods';

    protected $guarded = [];

    public function topic(){
        return $this->belongsTo('App\Models\Topic','topic_uid');
    }

    public function plate(){
        return $this->belongsTo('App\Models\Plate','plate_uid');
    }
    
    public function category(){
        return $this->belongsTo('App\Models\Category','category_uid');
    }

    public function getStatusAttribute($value) {
        $map = [
            'on_sale' => '出售中',
            'off_sale' => '已停售',
        ];

        return $map[$value];
    }

}
