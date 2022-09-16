<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
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
        //To prevent fillable error. If you are using this unguard you should know about the correct way of adding items to database in ListingController.php create($formFields) section. do not write it like create($request->all())
        Model::unguard();
    }
}
