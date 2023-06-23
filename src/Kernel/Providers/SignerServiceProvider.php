<?php

namespace Weiliu\Open\Kernel\Providers;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Weiliu\Open\Kernel\Signer;

class SignerServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['signer'] = function () {
            return new Signer();
        };
    }
}