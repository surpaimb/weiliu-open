<?php

namespace Weiliu\Open\Cps\Taobaoke;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['taobaoke'] = function ($app) {
            return new TaobaokeClient($app);
        };
    }
}