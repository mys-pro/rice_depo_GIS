<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class export extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'customer_id',
        'warehouse_id',
        'note',
    ];

    public function export_detail()
    {
        return $this->hasMany(export_detail::class, 'export_id', 'id');
    }
}
