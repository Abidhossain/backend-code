<?php

namespace App\Providers;

use App\Repository\Interfaces\CategoryInterface;
use App\Repository\Interfaces\ProductInterface;
use App\Repository\Repositories\CategoryRepository;
use App\Repository\Repositories\ProductRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {

        $this->app->bind(
            CategoryInterface::class,
            CategoryRepository::class,
            ProductInterface::class,
            ProductRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
