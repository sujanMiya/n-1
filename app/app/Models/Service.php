<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['uid', 'name', 'description', 'price', 'status'];
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
