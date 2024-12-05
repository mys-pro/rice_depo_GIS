<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class import_detail extends Model
{
    use HasFactory;
    protected $fillable = [
        'rice_id',
        'weight',
        'price',
    ];

    public function import()
    {
        return $this->belongsTo(import::class, 'import_id', 'id');
    }
}
