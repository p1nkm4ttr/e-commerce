<?php

namespace App\Providers;

use Livewire\Livewire;
use App\Livewire\OrderComponent as Order;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Livewire::component('order', Order::class);
    }
}
