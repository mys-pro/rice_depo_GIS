<?php

namespace App\Repositories;

use App\Models\warehouse;
use App\Repositories\Interfaces\WarehouseRepositoryInterface;
use App\Repositories\BaseRepository;

/**
 * Class UserService
 * @package App\Services
 */
class WarehouseRepository extends BaseRepository implements WarehouseRepositoryInterface
{
    protected $model;

    public function __construct(warehouse $model)
    {
        $this->model = $model;
    }

    public function getAllPaginate()
    {
        return $this->model->orderBy('id', 'desc')->paginate(20);
    }

    public function getPaginateByName($name)
    {
        return $this->model->where('name', 'like', "%{$name}%")->orderBy('id', 'desc')->paginate(20);
    }
}
