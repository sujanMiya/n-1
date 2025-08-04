<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['uid','name','description','prise','status'];
    public function hasUuid()
    {
        static::creating(function($service){
            if(empty($model->uuid)){
                $service->uuid = (string) 'ser-'.Str::uuid();
            }
        });
    }
}
