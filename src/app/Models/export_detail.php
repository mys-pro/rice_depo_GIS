<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class export_detail extends Model
{
    use HasFactory;

    protected $fillable = [
        'rice_id',
        'weight',
        'price',
    ];

    public function export()
    {
        return $this->belongsTo(export::class, 'export_id', 'id');
    }
}
