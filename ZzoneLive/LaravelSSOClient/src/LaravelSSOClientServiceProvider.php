<?php

namespace ZzoneLive\LaravelSSOClient;

use Illuminate\Support\ServiceProvider;
use ZzoneLive\LaravelSSOClient\View\Components\SSOAutoLogin;

class LaravelSSOClientServiceProvider extends ServiceProvider
{
    public function boot()
    {
        \Illuminate\Support\Facades\Blade::component('sso-auto-login', SSOAutoLogin::class);
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'LaravelSSOClient');
    }

    public function register()
    {
        //
    }
}
