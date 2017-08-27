<?php

namespace App\Providers;

use App\traits\CustomErrorResponsesTrait;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    use CustomErrorResponsesTrait;
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $this->customErrorResponses();
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
