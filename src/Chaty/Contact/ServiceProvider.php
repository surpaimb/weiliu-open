<?php

namespace Weiliu\Open\Chaty\Contact;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['contact'] = function ($app) {
            return new ContactClient($app);
        };
    }
}