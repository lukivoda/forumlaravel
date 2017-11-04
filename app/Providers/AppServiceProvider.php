<?php

namespace App\Providers;

use App\Channel;
use Illuminate\Support\ServiceProvider;
//use Illuminate\View\View;

//ova go vklucuvane(se vklucuva view so facades)
use Illuminate\Support\Facades\View;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    //so ovaa metoda boot channels go pravime dostapen na seka niz aplikacijata pri nejzino pokrenuvanje
    public function boot()
    {
        View::share('channels',Channel::all());
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
