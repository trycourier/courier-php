<?php

namespace Courier\Laravel\Providers;

use Courier\Courier;
use Illuminate\Support\ServiceProvider;

class CourierServiceProvider extends ServiceProvider
{

    public function register()
    {

        $this->app->bind('courier', function () {

            $courier_auth_token = config('services.courier.auth_token');
            $courier_email = config('services.courier.email');

            $client = new Courier($courier_auth_token, $courier_email);

            return $client;

        });

    }

}
