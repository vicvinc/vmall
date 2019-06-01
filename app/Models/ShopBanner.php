<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

class ShopBanner extends BaseModel {

    protected $table = 'shop_banner';

    protected $guarded = [];

    public function getStatusAttribute($value) {
        $map = [
            'show' => '显示',
            'hide' => '隐藏',
        ];

        return $map[$value];
    }
}
