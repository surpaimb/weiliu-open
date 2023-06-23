<?php

namespace Weiliu\Open\Support\Charge;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['charge'] = function ($app) {
            return new Charge($app);
        };
    }
}