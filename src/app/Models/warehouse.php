<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class warehouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'name',
        'longitude',
        'latitude',
        'address',
        'status',
    ];
}