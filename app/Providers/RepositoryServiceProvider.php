<?php

namespace CodeDelivery\Providers;

use CodeDelivery\Models\Guest;
use CodeDelivery\Repositories\CategoryRepository;
use CodeDelivery\Repositories\CategoryRepositoryEloquent;
use CodeDelivery\Repositories\CheckinRepository;
use CodeDelivery\Repositories\CheckinRepositoryEloquent;
use CodeDelivery\Repositories\ClientRepository;
use CodeDelivery\Repositories\ClientRepositoryEloquent;
use CodeDelivery\Repositories\CupomRepository;
use CodeDelivery\Repositories\CupomRepositoryEloquent;
use CodeDelivery\Repositories\EmployeeRepository;
use CodeDelivery\Repositories\EmployeeRepositoryEloquent;
use CodeDelivery\Repositories\GuestRepository;
use CodeDelivery\Repositories\GuestRepositoryEloquent;
use CodeDelivery\Repositories\HotelRepository;
use CodeDelivery\Repositories\HotelRepositoryEloquent;
use CodeDelivery\Repositories\OrderItemRepositoryEloquent;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\OrderRepositoryEloquent;
use CodeDelivery\Repositories\ProductRepository;
use CodeDelivery\Repositories\ProductRepositoryEloquent;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Repositories\UserRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            CategoryRepository::class,
            CategoryRepositoryEloquent::class
        );

        $this->app->bind(
            ProductRepository::class,
            ProductRepositoryEloquent::class
        );

        $this->app->bind(
            ClientRepository::class,
            ClientRepositoryEloquent::class
        );

        $this->app->bind(
            UserRepository::class,
            UserRepositoryEloquent::class
        );

        $this->app->bind(
            OrderRepository::class,
            OrderRepositoryEloquent::class
        );

        $this->app->bind(
            CupomRepository::class,
            CupomRepositoryEloquent::class
        );

        $this->app->bind(
            GuestRepository::class,
            GuestRepositoryEloquent::class
        );
        $this->app->bind(
            HotelRepository::class,
            HotelRepositoryEloquent::class
        );
        $this->app->bind(
            CheckinRepository::class,
            CheckinRepositoryEloquent::class
        );
        $this->app->bind(
            EmployeeRepository::class,
            EmployeeRepositoryEloquent::class
        );

    }
}
