<?php

namespace App\Repositories\Interfaces;

interface ImportRepositoryInterface extends BaseRepositoryInterface
{
    public function getAll();
    public function getByName($name);
    public function getWeight($warehouseId, $riceId);
    public function statistical($warehouseId, $from, $to);
    public function getPriceTotal($warehouseId, $from, $to);
}