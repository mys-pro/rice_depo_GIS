<?php

namespace App\Repositories;

use App\Models\rice;
use App\Repositories\Interfaces\RiceRepositoryInterface;
use App\Repositories\BaseRepository;

class RiceRepository extends BaseRepository implements RiceRepositoryInterface
{
    protected $model;

    public function __construct(rice $model)
    {
        $this->model = $model;
    }
}