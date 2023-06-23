<?php

namespace Weiliu\Open\Chaty\Auth;

use Weiliu\Open\Kernel\AccessToken as BaseAccessToken;
use Weiliu\Open\Kernel\Support\Str;

class AccessToken extends BaseAccessToken
{
    protected function appendQuery(): array
    {
        $accessToken = $this->app->signer->sign([
            'token' => $this->app->config->get('appsecret'),
            'nonce' => $nonce = Str::random(32),
            'timestamp' => $timestamp = time()
        ]);

        return [
            'appid' => $this->app->config->get('appid'),
            'timestamp' => $timestamp,
            'nonce' => $nonce,
            'access_token' => $accessToken,
        ];
    }
}