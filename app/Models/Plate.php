<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

class Plate extends BaseModel {

    protected $table = 'plate';

    protected $guarded = [];

    public function goods(){
        return $this->hasMany('App\Models\Goods','plate_id');
    }

    public function getStatusAttribute($value) {
        $map = [
            'show' => '显示',
            'hide' => '隐藏',
        ];

        return $map[$value];
    }
}
