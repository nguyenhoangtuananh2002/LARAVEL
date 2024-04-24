<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    protected $services = [
        'App\Admin\Services\User\UserServiceInterface' =>

            'App\Admin\Services\User\UserService',

    ];
}
