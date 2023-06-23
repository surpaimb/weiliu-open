<?php

namespace Weiliu\Open\Support\Auth;

use SDK\Kernel\AccessToken as BaseAccessToken;
use SDK\Kernel\Support\Str;

class AccessToken extends BaseAccessToken
{
    /**
     * @var \Weiliu\Open\Support\Application
     */
    protected $app;

    protected function appendQuery(): array
    {
        $accessToken = $this->app->signer->sign([
            'token' => $this->app->config->get('token'),
            'nonce' => $nonce = Str::random(32),
            'timestamp' => $timestamp = time()
        ]);

        return [
            'timestamp' => $timestamp,
            'nonce' => $nonce,
            'access_token' => $accessToken,
        ];
    }
}