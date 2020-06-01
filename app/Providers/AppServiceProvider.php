<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\Core\ConsoleHelper;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton('myapp.console.helper', function(){
            return new ConsoleHelper();
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        require(app_path('Helpers/Functions.php'));
    }
}
