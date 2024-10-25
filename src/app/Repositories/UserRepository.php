<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserService
 * @package App\Services
 */
class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getAllPaginate()
    {
        return $this->model->from('users as u')
            ->select('u.*', 'uc.name as user_catalogue_name')
            ->join('user_catalogues as uc', 'u.user_catalogue_id', '=', 'uc.id')
            ->orderBy('u.id', 'desc')
            ->paginate(20);
    }

    public function getPaginateBy(array $where = [])
    {
        return $this->model->from('users as u')
            ->select('u.*', 'uc.name as user_catalogue_name')
            ->join('user_catalogues as uc', 'u.user_catalogue_id', '=', 'uc.id')
            ->where($where)
            ->orderBy('u.id', 'desc')
            ->paginate(20);
    }

    public function getWithCatalogueById($id)
    {
        return $this->model->from('users as u')
            ->select('u.*', 'uc.name as user_catalogue_name')
            ->join('user_catalogues as uc', 'u.user_catalogue_id', '=', 'uc.id')
            ->where('u.id', '=', $id)
            ->get();
    }
}