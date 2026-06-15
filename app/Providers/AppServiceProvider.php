<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\AdminSetting;
use Illuminate\Support\Facades\View;

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
        View::composer('*', function ($view) {
            $view->with('site_phone', AdminSetting::get('site_phone', '+91 83218 90640'));
            $view->with('site_email', AdminSetting::get('site_email', 'info@synstarstaffing.com'));
        });
    }
    
}
