<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;

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

        //create global variable
        $company1="Hackshade Technologies";
        $company2="Chaaruvi Infotech";
        View::share(['company1'=>$company1,'company2'=>$company2]);
    }
}
