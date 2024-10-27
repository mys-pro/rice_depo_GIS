<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use App\Repositories\Interfaces\UserCatalogueRepositoryInterface as UserCatalogueRepository;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    protected $userRepository;
    protected $userCatalogueRepository;
    protected $page;

    public function __construct(UserRepository $userRepository, UserCatalogueRepository $userCatalogueRepository)
    {
        $this->userRepository = $userRepository;
        $this->userCatalogueRepository = $userCatalogueRepository;
        $this->page = 'dashboard';
    }

    public function index()
    {
        $page = $this->page;
        $main = 'home';
        $config = $this->config();
        return view('backend.dashboard.layout', compact(
            'page',
            'main',
            'config',
        ));
    }

    private function config()
    {
        return [
            'css' => [
                'backend/vendor/jquery-ui/css/jquery-ui.min.css',
                'backend/vendor/mapbox-gl/css/mapbox-gl.min.css',
            ],

            'js' => [
                'backend/vendor/jquery-ui/js/jquery-ui.min.js',
                'backend/vendor/mapbox-gl/js/mapbox-gl.min.js', 
            ],
        ];
    }
}
