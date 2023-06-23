<?php

namespace Weiliu\Open\Chaty\Robot;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['robot'] = function ($app) {
            return new Robot($app);
        };

        $app['robot.auth'] = function ($app) {
            return new AuthClient($app);
        };

        $app['robot.room'] = function ($app) {
            return new RoomClient($app);
        };

        $app['robot.contact'] = function ($app) {
            return new ContactClient($app);
        };
    }
}