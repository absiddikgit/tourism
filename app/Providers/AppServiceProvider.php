<?php

namespace App\Providers;

use App\Models\Role;
use App\Models\Admin\Place\Place;
use App\Models\Admin\Package\Type;
use Illuminate\Support\Facades\View;
use App\Models\Admin\Package\Package;
use Illuminate\Support\Facades\Schema;
use App\Models\Admin\Location\Division;
use App\Models\Admin\Hotel\Hotel;
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
        View::share('top_5_places', Place::select('title')->latest()->take(5)->get());
        View::share('top_5_hotels', Hotel::select('name')->latest()->take(5)->get());
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
