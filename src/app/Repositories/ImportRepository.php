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
            ->orderBy('i.id')
            ->paginate(20);
    }

    public function getWeight($warehouseId, $riceId)
    {
        return $this->model->from('imports as i')
            ->join('import_details as id', 'id.import_id', '=', 'i.id')
            ->where('i.warehouse_id', $warehouseId)
            ->where('id.rice_id', $riceId)
            ->sum('id.weight');
    }

    public function statistical($warehouseId, $from = null, $to = null)
    {
        $from = $from ?? date('Y-m-01');
        $to = $to ?? date('Y-m-t');
        return $this->model->from('imports as i')
            ->select('r.name', \DB::raw('SUM(id.weight) as total_weight'))
            ->join('import_details as id', 'i.id', '=', 'id.import_id')
            ->join('rice as r', 'id.rice_id', '=', 'r.id')
            ->whereBetween('i.created_at', [$from, $to])
            ->where('i.warehouse_id', $warehouseId)
            ->groupBy('r.id')
            ->get();

    }

    public function getPriceTotal($warehouseId, $from = null, $to = null)
    {
        $from = $from ?? date('Y-m-01');
        $to = $to ?? date('Y-m-t');
        return $this->model->from('imports as i')
            ->join('import_details as id', 'i.id', '=', 'id.import_id')
            ->whereBetween('i.created_at', [$from, $to])
            ->where('i.warehouse_id', $warehouseId)
            ->sum(\DB::raw('id.weight * id.price'));
    }
}