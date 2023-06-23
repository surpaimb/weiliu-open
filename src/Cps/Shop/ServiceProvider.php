<?php

namespace Weiliu\Open\Cps\Shop;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['shop'] = function ($app) {
            return new ShopClient($app);
        };
    }
}