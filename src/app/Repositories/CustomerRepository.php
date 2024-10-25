<?php

namespace App\Repositories;

use App\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Models\customer;

class CustomerRepository extends BaseRepository implements CustomerRepositoryInterface {
    protected $model;
    public function __construct(customer $model) {
        $this->model = $model;
    }
    public function getPaginateBy(array $where = []) {
        return $this->model->where($where)->orderBy('id', 'DESC')->paginate(20);
    }
}