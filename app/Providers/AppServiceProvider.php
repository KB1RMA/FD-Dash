<?php

namespace App\Providers;

use App\Qso;
use Event;
use App\Events\NewQso;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // When  a new QSO has been created, let's trigger the event so it'll be
        //  broadcast via websocket to our frontend UI

        Qso::saved(function ($qso) {
            Event::fire(new NewQso($qso));
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