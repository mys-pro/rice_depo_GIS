<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class import extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'customer_id',
        'warehouse_id',
        'note',
    ];

    public function import_detail()
    {
        return $this->hasMany(import_detail::class, 'import_id', 'id');
    }
}
