<?php

namespace Weiliu\Open\UrlShortener\Auth;

use Psr\Http\Message\RequestInterface;
use Weiliu\Open\Kernel\AccessToken as BaseAccessToken;

class AccessToken extends BaseAccessToken
{
    public function applyToRequest(RequestInterface $request, array $requestOptions = []): RequestInterface
    {
        $request = $request->withHeader('appid', $this->app->config->get('appid'))
            ->withHeader('appsecret', $this->app->config->get('appsecret'));

        if ($publickey = $this->app->config->get('publickey')) {
            $request = $request->withHeader('publickey', $publickey);
        }

        return $request;
    }
}