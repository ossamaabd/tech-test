<?php

namespace App\Providers;

use App\Interfaces\SubscriberInterface;
use App\Repository\SubscriberRepository;
use Illuminate\Support\ServiceProvider;

class SubscriberProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SubscriberInterface::class,SubscriberRepository::class);

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
