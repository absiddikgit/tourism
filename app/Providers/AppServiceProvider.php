<?php

namespace App\Providers;

use App\Models\Role;
use App\Models\Admin\Package\Type;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Models\Admin\Location\Division;
use Illuminate\Support\ServiceProvider;

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
        // View::composer('layouts.frontend', function ($view) {
        //     $view->with('package_types', Type::orderBy('type')->get());
        // });
        //
        View::share('package_types', Type::orderBy('type')->get());
        View::share('divisions', Division::orderBy('name')->get());
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
