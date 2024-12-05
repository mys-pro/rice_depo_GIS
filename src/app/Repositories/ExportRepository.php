<?php

namespace App\Repositories;

use App\Models\export;
use App\Repositories\Interfaces\ExportRepositoryInterface;
use App\Repositories\BaseRepository;

class ExportRepository extends BaseRepository implements ExportRepositoryInterface
{
    protected $model;

    public function __construct(export $model)
    {
        $this->model = $model;
    }

    public function getByName($name = '')
    {
        return $this->model->from('exports as e')
            ->select('e.id', 'u.name as user_name', 'ct.name as customer_name', 'wh.name as warehouse_name', 'e.created_at')
            ->join('users as u', 'e.user_id', '=', 'u.id')
            ->join('customers as ct', 'e.customer_id', '=', 'ct.id')
            ->join('warehouses as wh', 'e.warehouse_id', '=', 'wh.id')
            ->where('u.name', 'LIKE', "%{$name}%")
            ->orWhere('ct.name', 'LIKE', "%{$name}%")
            ->orWhere('wh.name', 'LIKE', "%{$name}%")
            ->orderBy('e.id')
            ->paginate(20);
    }

    public function getWeight($warehouseId, $riceId)
    {
        return $this->model->from('exports as e')
            ->join('export_details as ed', 'ed.export_id', '=', 'e.id')
            ->where('e.warehouse_id', $warehouseId)
            ->where('ed.rice_id', $riceId)
            ->sum('ed.weight');
    }

    public function getWeightDetail($exportId, $riceId)
    {
        return $this->model->from('exports as e')
            ->join('export_details as ed', 'ed.export_id', '=', 'e.id')
            ->where('e.id', $exportId)
            ->where('ed.rice_id', $riceId)
            ->sum('ed.weight');
    }

    public function statistical($warehouseId, $from = null, $to = null)
    {
        $from = $from ?? date('Y-m-01');
        $to = $to ?? date('Y-m-t');
        return $this->model->from('exports as i')
            ->select('r.name', \DB::raw('SUM(id.weight) as total_weight'))
            ->join('export_details as id', 'i.id', '=', 'id.export_id')
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
        return $this->model->from('exports as i')
            ->join('export_details as id', 'i.id', '=', 'id.export_id')
            ->whereBetween('i.created_at', [$from, $to])
            ->where('i.warehouse_id', $warehouseId)
            ->sum(\DB::raw('id.weight * id.price'));
    }
}