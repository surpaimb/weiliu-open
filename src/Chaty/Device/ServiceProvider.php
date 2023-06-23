<?php

namespace Weiliu\Open\Chaty\Device;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['device'] = function ($app) {
            return new DeviceClient($app);
        };
    }
}