<?php

namespace App\Providers;

use App\Models\Setting;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //compose all the views....
        view()->composer('*', function ($view) 
        {
            $setting = Setting::first();
            view()->share('setting', $setting);
            
            $locale = App::currentLocale();
            view()->share('locale', $locale);
        });
    }
}
