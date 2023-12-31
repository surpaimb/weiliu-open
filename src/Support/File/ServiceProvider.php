<?php

namespace Weiliu\Open\Support\File;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['file'] = function ($app) {
            return new File($app);
        };
    }
}