<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;
class ValidatePhoneNumberProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('phone_number', function($attribute, $value, $parameters, $validator) {
            if ($value[0]=='+') {
                return is_numeric(substr($value,1));
            } else {
                if (substr($value, 0, 2) == '01') {
                    return  is_numeric(substr($value,2));
                }
                return false;
            }
        });
    }
}
