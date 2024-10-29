<?php

namespace App\Repositories;

use App\Models\import;
use App\Repositories\Interfaces\ImportRepositoryInterface;
use App\Repositories\BaseRepository;

class ImportRepository extends BaseRepository implements ImportRepositoryInterface
{
    protected $model;

    public function __construct(import $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->from('imports as i')
            ->select('i.id', 'u.name as user_name', 'ct.name as customer_name', 'wh.name as warehouse_name', 'i.created_at')
            ->join('users as u', 'i.user_id', '=', 'u.id')
            ->join('customers as ct', 'i.customer_id', '=', 'ct.id')
            ->join('warehouses as wh', 'i.warehouse_id', '=', 'wh.id')
            ->get();
    }

    public function getByName($name = '')
    {
        return $this->model->from('imports as i')
            ->select('i.id', 'u.name as user_name', 'ct.name as customer_name', 'wh.name as warehouse_name', 'i.created_at')
            ->join('users as u', 'i.user_id', '=', 'u.id')
            ->join('customers as ct', 'i.customer_id', '=', 'ct.id')
            ->join('warehouses as wh', 'i.warehouse_id', '=', 'wh.id')
            ->where('u.name', 'LIKE', "%{$name}%")
            ->orWhere('ct.name', 'LIKE', "%{$name}%")
            ->orWhere('wh.name', 'LIKE', "%{$name}%")
            ->get();
    }
}