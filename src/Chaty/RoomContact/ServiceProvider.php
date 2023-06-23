<?php

namespace Weiliu\Open\Chaty\RoomContact;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['roomContact'] = function ($app) {
            return new RoomContactClient($app);
        };
    }
}