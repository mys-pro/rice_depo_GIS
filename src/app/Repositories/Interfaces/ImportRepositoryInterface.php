<?php

namespace App\Repositories\Interfaces;

interface ImportRepositoryInterface extends BaseRepositoryInterface
{
    public function getAll();
    public function getByName($name);
}