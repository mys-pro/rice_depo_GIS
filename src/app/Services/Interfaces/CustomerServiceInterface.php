<?php

namespace App\Services\Interfaces;

interface CustomerServiceInterface
{
    public function create($request);
    public function update($id, $request);
    public function delete($id);
}