<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\UserInterface;
use App\Interfaces\DepartementInterface;
use App\Interfaces\UnitInterface;
use App\Interfaces\ItemInterface;
use App\Interfaces\CustomerInterface;
use App\Repositories\UserRepository;
use App\Repositories\DepartementRepository;
use App\Repositories\UnitRepository;
use App\Repositories\ItemRepository;
use App\Repositories\CustomerRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(DepartementInterface::class, DepartementRepository::class);
        $this->app->bind(UnitInterface::class, UnitRepository::class);
        $this->app->bind(ItemInterface::class, ItemRepository::class);
        $this->app->bind(CustomerInterface::class, CustomerRepository::class);
    }
}
