<?php

namespace Weiliu\Open\WorkPhone\Device;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['device'] = function ($app) {
            return new Device($app);
        };
    }
}