<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class BaseModel extends Model {
    public static function boot() {
        parent::boot();
        self::creating(function ($model) {
            $model->uid = Uuid::generate(4)->string;
        });
    }
}
