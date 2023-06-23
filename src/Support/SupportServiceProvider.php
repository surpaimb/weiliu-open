<?php

namespace Weiliu\Open\Support;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class SupportServiceProvider extends BaseServiceProvider
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
            dirname(dirname(__DIR__)) . '/config/support.php' => function_exists('config_path')
                ? config_path('support.php')
                : base_path('config/support.php')
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
            $this->app->configure('support');
        }

        $this->mergeConfigFrom(dirname(dirname(__DIR__)) . '/config/support.php', 'support');


        $this->app->singleton(Application::class, function ($app) {
            return new Application(
                $app->make('config')->get('support', [])
            );
        });
    }
}