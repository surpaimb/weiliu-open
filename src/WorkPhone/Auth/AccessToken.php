<?php

namespace Weiliu\Open\WorkPhone\Auth;

use Psr\Http\Message\RequestInterface;
use SDK\Kernel\AccessToken as BaseAccessToken;
use SDK\Kernel\Http\Request;
use SDK\Kernel\Support\Str;

class AccessToken extends BaseAccessToken
{
    /**
     * @var \Weiliu\Open\WorkPhone\Application
     */
    protected $app;

    /**
     * @param $query
     * @param RequestInterface $request
     *
     * @return array
     * @throws \SDK\Kernel\Exceptions\RuntimeException
     */
    protected function appendQuery($query, RequestInterface $request): array
    {
        $appendQuery = [
            'app_key' => $appid = $this->app->config->get('appkey'),
            'nonce' => $nonce = Str::random(32),
            'timestamp' => $timestamp = time()
        ];

        $data = Request::buildFromPsrRequest($request)->toArray();

        $sign = $this->app->signer->sign(
            $query + $appendQuery + $data,
            $this->app->config->get('appsecret')
        );

        return [
            'app_key' => $appid,
            'nonce' => $nonce,
            'timestamp' => $timestamp,
            'sign' => $sign,
        ];
    }
}