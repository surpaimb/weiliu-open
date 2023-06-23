<?php

namespace Weiliu\Open\DingTalk\Robot;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['robot'] = function ($app) {
            return new RobotClient($app);
        };
    }
}