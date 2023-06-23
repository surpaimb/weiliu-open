<?php

namespace Weiliu\Open\WorkPhone;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class WorkPhoneServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // 发布配置
        $this->publishes([
            dirname(dirname(__DIR__)) . '/config/workphone.php' => function_exists('config_path')
                ? config_path('workphone.php')
                : base_path('config/workphone.php')
        ], 'config');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (method_exists($this->app, 'configure')) {
            $this->app->configure('workphone');
        }

        $this->mergeConfigFrom(dirname(dirname(__DIR__)) . '/config/workphone.php', 'workphone');


        $this->app->singleton(Application::class, function ($app) {
            return new Application(
                $app->make('config')->get('workphone', [])
            );
        });
    }
}