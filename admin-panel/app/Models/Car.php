<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'name',
        'plate_number',
        'images',
        'status'
    ];

    protected $casts = [
        'images' => 'array'
    ];
}
