<?php

namespace App\Repositories\Interfaces;

/**
 * Interface UserServiceInterface
 * @package App\Services\Interfaces
 */
interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function getAllPaginate();
    public function getPaginateBy(array $where);
    public function getWithCatalogueById($id);
    public function getTotalByWarehouse($warehouseId);
}