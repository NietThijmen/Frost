<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class OrganisationServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        $this->app->bind('organisation', function () {
            $cookie = request()->cookie('organisation');
            if(!$cookie) {
                return null;
            }

            if(!auth()->user()) {
                return null;
            }

            return auth()->user()->organisations->find($cookie);



        });
    }
}
