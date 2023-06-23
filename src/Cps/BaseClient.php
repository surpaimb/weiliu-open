<?php

namespace Weiliu\Open\Cps;

use GuzzleHttp\Exception\BadResponseException;
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

        throw $e;
    }
}