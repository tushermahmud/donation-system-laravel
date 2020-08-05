<?php

namespace App\Providers;

use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @param UrlGenerator $url
     * @return void
     */
    public function boot(UrlGenerator $url)
    {
        if(env('REDIRECT_HTTPS'))
        {
            $url->forceSchema('https');
        }
        Schema::defaultStringLength(191);

    Validator::extend('greater_than_field', function($attribute, $value, $parameters, $validator) {
        $min_field = $parameters[0];
        $data = $validator->getData();
        $min_value = $data[$min_field];
        return $value > $min_value;
        });   

    Validator::replacer('greater_than_field', function($message, $attribute, $rule, $parameters) {
        $message="donation_needed must be greater than Donation_collection";
        return str_replace(':field', $parameters[0], $message);
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
