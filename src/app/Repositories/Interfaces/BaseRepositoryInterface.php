<?php

namespace App\Repositories\Interfaces;

/**
 * Interface BaseServiceInterface
 * @package App\Services\Interfaces
 */
interface BaseRepositoryInterface
{
    public function all();
    public function findById(int $id, array $column, array $options);
    public function findSelectById(int $id, array $column = ["*"]);
    public function find(int $id);
    public function findByName($name = '');
    public function create(array $data);
    public function update(int $id, array $payload);
    public function delete($id);
}