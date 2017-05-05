<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;

class CustomValidatorProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot() {
//        Validator::extend('one_of_three', function($attribute, $value, $parameters) {
//            echo "<pre>";
//            print_r($attribute);
//            exit;
//            return substr($value, 0, 3) == '+44';
//        });
//        $this->app['validator']->extend('one_of_three', function ($attribute, $value, $parameters) {
//            
//            echo "<pre>";
//            print_r($parameters);
//            exit;
//            return ($value != '' && $this->getValue($parameters[0]) != '' && $this->getValue($parameters[1]) != '') ? true : false;
//        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        //
    }

}
