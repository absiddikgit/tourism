<?php

namespace App\Providers;

use App\Models\Role;
use Illuminate\Support\Facades\View;
use  Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Models\Admin\Package\PackageType;

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
        View::composer('layouts.frontend', function ($view) {
            $view->with('package_types', PackageType::orderBy('type')->get());
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
