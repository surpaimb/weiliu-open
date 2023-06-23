<?php

namespace Weiliu\Open\Chaty\Room;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['room'] = function ($app) {
            return new RoomClient($app);
        };
    }
}