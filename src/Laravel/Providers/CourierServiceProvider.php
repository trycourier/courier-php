<?php

namespace Courier\Laravel\Providers;

use Courier\CourierClient;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class CourierServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('courier', function () {
            return new CourierClient(
                Config::get('services.courier.base_url'),
                Config::get('services.courier.auth_token'),
                Config::get('services.courier.username'),
                Config::get('services.courier.password'));
        });
    }
}
