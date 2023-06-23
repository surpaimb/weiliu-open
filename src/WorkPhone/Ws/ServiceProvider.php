<?php

namespace Weiliu\Open\WorkPhone\Ws;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['ws'] = function ($app) {
            return new Ws($app);
        };
    }
}