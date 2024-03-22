<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

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
        Request::macro("username", function(){
            return $this->username ?? "not set";
        });

        Str::macro('stringlength', function($str, int $length){
            return static::length($str)==$length;
        });
    }
}
