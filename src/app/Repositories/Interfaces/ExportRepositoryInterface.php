<?php

namespace App\Repositories\Interfaces;

interface ExportRepositoryInterface extends BaseRepositoryInterface
{
    public function getByName($name);
    public function getWeight($warehouseId, $riceId);
    public function getWeightDetail($exportId, $riceId);
    public function statistical($warehouseId, $from, $to);
    public function getPriceTotal($warehouseId, $from, $to);
}