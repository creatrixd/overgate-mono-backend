<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccessEvent extends Model
{
    protected $fillable = [
        'car_id',
        'kind'
    ];

    public function car() {
        return $this->belongsTo(Car::class);
    }
}
