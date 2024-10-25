<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rice extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];
}
