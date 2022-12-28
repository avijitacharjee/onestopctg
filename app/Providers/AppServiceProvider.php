<?php

namespace App\Providers;

use App\View\Components\ContentHeader;
use App\View\Components\PaymentStatus;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('content-header', ContentHeader::class);
        // Blade::component('payment-status',PaymentStatus::class);
    }
}
