<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $serviceBindings = [
        'App\Services\Interfaces\UserServiceInterface' => 'App\Services\UserService',
        'App\Repositories\Interfaces\UserRepositoryInterface' => 'App\Repositories\UserRepository',

        'App\Repositories\Interfaces\UserCatalogueRepositoryInterface' => 'App\Repositories\UserCatalogueRepository',

        'App\Services\Interfaces\WarehouseServiceInterface' => 'App\Services\WarehouseService',
        'App\Repositories\Interfaces\WarehouseRepositoryInterface' => 'App\Repositories\WarehouseRepository',

        'App\Services\Interfaces\RiceServiceInterface' => 'App\Services\RiceService',
        'App\Repositories\Interfaces\RiceRepositoryInterface' => 'App\Repositories\RiceRepository',

        'App\Services\Interfaces\CustomerServiceInterface' => 'App\Services\CustomerService',
        'App\Repositories\Interfaces\CustomerRepositoryInterface' => 'App\Repositories\CustomerRepository',
    ];
    /**
     * Register any application services.
     */
    public function register(): void
    {
        foreach ($this->serviceBindings as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
