<?php

namespace App\Providers;

use App\Interfaces\BlogInterface;
use App\Repository\BlogRepository;
use Illuminate\Support\ServiceProvider;

class BlogProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BlogInterface::class,BlogRepository::class);

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
