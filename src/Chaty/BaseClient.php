<?php

namespace Weiliu\Open\Chaty;

use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\GuzzleException;
use Weiliu\Open\Kernel\BaseClient as KernelBaseClient;

class BaseClient extends KernelBaseClient
{
    /**
     * @param GuzzleException $e
     *
     * @return array|object|\Psr\Http\Message\ResponseInterface|string|\Weiliu\Open\Kernel\Support\Collection
     * @throws GuzzleException
     * @throws \Weiliu\Open\Kernel\Exceptions\InvalidConfigException
     */
    protected function handleRequestException(GuzzleException $e)
    {
        if ($e instanceof BadResponseException) {
            return $this->unwrapResponse($e->getResponse());
        }

        if ($e instanceof ConnectException) {
            return [
                'code' => -1,
                'message' => sprintf('请求超时(%s秒)', $this->getHttpClient()->getConfig('timeout')),
                'errors' => []
            ];
        }

        throw $e;
    }
}