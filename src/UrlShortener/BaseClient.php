<?php

namespace Weiliu\Open\UrlShortener;

use Psr\Http\Message\ResponseInterface;
use Weiliu\Open\Kernel\BaseClient as KernelBaseClient;

class BaseClient extends KernelBaseClient
{
    /**
     * @param ResponseInterface $response
     *
     * @return array|mixed|object|ResponseInterface|string|\Weiliu\Open\Kernel\Support\Collection
     */
    protected function unwrapResponse(ResponseInterface $response)
    {
        $contentType = $response->getHeaderLine('Content-Type');
        $contents = $response->getBody()->getContents();

        if (false !== stripos($contentType, 'json') || stripos($contentType, 'javascript')) {
            return json_decode($contents, true);
        } else if (false !== stripos($contentType, 'xml')) {
            return json_decode(json_encode(simplexml_load_string($contents, 'SimpleXMLElement', LIBXML_NOCDATA), JSON_UNESCAPED_UNICODE), true);
        }

        return $contents;
    }
}