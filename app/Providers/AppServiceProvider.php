<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Model\user\System;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        view()->composer('user.layouts.sidebar', function ($view) {

            $logo=System::latest()->first();

            $view->with('logo', $logo);
        });

        view()->composer('user.layouts.topbar', function ($view) { 

            $company=System::latest()->first();

            $view->with('company', $company);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
