<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

class Topic extends BaseModel {

    protected $table = 'topic';

    protected $guarded = [];

    public function goods(){
        return $this->hasMany('App\Models\Topic','topic_uid','uid');
    }

    public function getStatusAttribute($value) {
        $map = [
            'show' => '显示',
            'hide' => '隐藏',
        ];

        return $map[$value];
    }

}
