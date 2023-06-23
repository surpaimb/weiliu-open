<?php

namespace Weiliu\Open\Kernel\Providers;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Symfony\Component\HttpFoundation\Request;

class RequestServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['request'] = function () {
            return Request::createFromGlobals();
        };
    }
}