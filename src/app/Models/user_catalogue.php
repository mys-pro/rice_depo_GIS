<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_catalogue extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];
}
