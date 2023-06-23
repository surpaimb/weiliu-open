<?php

namespace Weiliu\Open\Cps\Coupon;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['coupon'] = function ($app) {
            return new CouponClient($app);
        };
    }
}