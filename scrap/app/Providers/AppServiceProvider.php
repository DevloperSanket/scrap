<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Models\pincode;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Validator::extend('valid_pincode', function ($attribute, $value, $parameters, $validator) {
            $pincode = Pincode::where('pincode', $value)->first();

            return $pincode && $pincode->status == 1;
        }, 'Pincode is not serviceable.');
    }
}
