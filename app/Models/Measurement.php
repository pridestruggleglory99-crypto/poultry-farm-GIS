<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Measurement extends Model
{
    protected $fillable = [
        'farm_id',
        'object_name',
        'length',
        'width',
        'area',
    ];

    public function farm()
    {
        return $this->belongsTo(Farm::class);
    }
}