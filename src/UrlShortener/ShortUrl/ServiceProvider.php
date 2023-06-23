<?php

namespace Weiliu\Open\UrlShortener\ShortUrl;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['shortUrl'] = function ($app) {
            return new ShortUrlClient($app);
        };
    }
}