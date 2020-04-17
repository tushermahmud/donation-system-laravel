<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Donation;
use App\User;
class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.slider',function($view){
            $newPosts=Donation::get()->sortByDesc('created_at')->take(4);
            return $view->with('newPosts',$newPosts);
        });
        
        
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
