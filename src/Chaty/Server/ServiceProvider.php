<?php

namespace Weiliu\Open\Chaty\Server;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['server'] = function ($app) {
            return new Guard($app);
        };
    }
}