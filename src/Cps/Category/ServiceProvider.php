<?php

namespace Weiliu\Open\Cps\Category;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['category'] = function ($app) {
            return new CategoryClient($app);
        };
    }
}