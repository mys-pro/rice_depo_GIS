<?php

namespace App\Services\Interfaces;

/**
 * Interface UserServiceInterface
 * @package App\Services\Interfaces
 */
interface WarehouseServiceInterface
{
    public function create($request);
    public function update($id, $request);
    public function delete($id);
}
