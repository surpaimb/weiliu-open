<?php

namespace Weiliu\Open\WorkPhone\Chatroom;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['chatroom'] = function ($app) {
            return new Chatroom($app);
        };
    }
}