<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Validator;

class CodeValidationProvider extends ServiceProvider
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
        Validator::extend('code', function ($attribute, $value, $parameters, $validator) {
            $member = DB::table('customers')->where('customer_code', $value)->get();
            return $member->isEmpty() ? false : true;
        });
    }
}
