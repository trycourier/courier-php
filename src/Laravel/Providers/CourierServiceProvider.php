<?php

namespace Courier\Laravel\Providers;

use Courier\CourierClient;
use Illuminate\Support\ServiceProvider;

class CourierServiceProvider extends ServiceProvider
{

    public function register()
    {

        $this->app->bind('courier', function () {

            $courier_base_url = config('services.courier.base_url');
            $courier_auth_token = config('services.courier.auth_token');
            $courier_username = config('services.courier.username');
            $courier_password = config('services.courier.password');

            $client = new CourierClient($courier_base_url, $courier_auth_token, $courier_username, $courier_password);

            return $client;

        });

    }

}
