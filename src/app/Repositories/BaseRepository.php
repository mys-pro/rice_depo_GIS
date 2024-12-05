<?php

namespace App\Repositories;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseService
 * @package App\Services
 */
class BaseRepository implements BaseRepositoryInterface
{
    protected $model;
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function create(array $payload = [])
    {
        $model = $this->model->create($payload);
        return $model->fresh();
    }

    public function all()
    {
        return $this->model->all();
    }

    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }

    public function findById(int $modelId, array $column = ["*"], array $relation = [])
    {
        // return $this->model->select($column)->with($relation)->findOrFail($modelId);
        return $this->model->select($column)->with($relation)->find($modelId);
    }

    public function findSelectById(int $id, array $column = ["*"])
    {
        return $this->model->select($column)->find($id);
    }

    public function findByName($name = '')
    {
        return $this->model->where('name', 'LIKE', "%{$name}%")->get();
    }

    public function update(int $id = 0, array $payload = [])
    {
        $model = $this->model->find($id);
        return $model->update($payload);
    }

    public function find(int $id)
    {
        return $this->model->find($id);
    }
}
