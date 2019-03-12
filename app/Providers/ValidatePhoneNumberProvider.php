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
                $phone = substr($value,1);
                return is_numeric($phone) && strlen($phone)<12 && strlen($phone)>8;
            } else {
                if (substr($value, 0, 1) == '0'|| substr($value, 0, 1) =='1') {
                    return  is_numeric(substr($value,2));
                }
                return false;
            }
        });
    }
}
