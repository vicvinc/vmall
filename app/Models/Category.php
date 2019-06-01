<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

class Category extends BaseModel {

    protected $table = 'category';

    protected $guarded = [];

    // goods
    public function goods() {
        return $this->hasMany('App\Models\goods', 'category_uid');
    }

    // children categories
    public function children() {
        return $this->hasMany('App\Models\Category', 'parent_uid', 'uid');
    }

    public function getTypeAttribute($value) {
        $map = [
            'first_cate' => '一级分类',
            'second_cate' => '二级分类',
        ];

        return $map[$value];
    }

}
