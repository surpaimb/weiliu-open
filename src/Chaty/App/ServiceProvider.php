<?php

namespace Weiliu\Open\Chaty\App;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['app'] = function ($app) {
            return new AppClient($app);
        };
    }
}