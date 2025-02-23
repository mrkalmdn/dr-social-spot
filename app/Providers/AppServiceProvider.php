<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Plmrlnsnts\Commentator\Facades\Commentator;

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
        Commentator::routes(['middleware' => 'api', 'prefix' => 'api']);
    }
}
