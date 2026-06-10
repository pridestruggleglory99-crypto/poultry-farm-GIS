<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Farm extends Model
{
    protected $fillable = [

        'name',

        'address',

        'phone',

        'category',

        'latitude',

        'longitude',

        'google_maps',

        'screenshot'
    ];

    public function measurements()
{
    return $this->hasMany(
        \App\Models\Measurement::class
    );
}
}

