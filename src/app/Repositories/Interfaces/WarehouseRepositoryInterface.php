<?php

namespace App\Repositories\Interfaces;

/**
 * Interface UserServiceInterface
 * @package App\Services\Interfaces
 */
interface WarehouseRepositoryInterface extends BaseRepositoryInterface
{
    public function getAllPaginate();
    public function getPaginateByName($name);
}