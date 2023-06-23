<?php

namespace Weiliu\Open\Chaty\Profile;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['profile'] = function ($app) {
            return new ProfileClient($app);
        };
    }
}