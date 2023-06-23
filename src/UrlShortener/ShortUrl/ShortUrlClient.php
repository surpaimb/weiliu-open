<?php

namespace Weiliu\Open\UrlShortener\ShortUrl;

use Weiliu\Open\UrlShortener\BaseClient;

class ShortUrlClient extends BaseClient
{
    /**
     * @param $target
     *
     * @return array|null|string
     */
    public function create($target)
    {
        return $this->httpPost('/v1/short_urls', ['target' => $target]);
    }

    /**
     * @return array|null|string
     */
    public function reset()
    {
        return $this->httpPost('/v1/short_urls/reset', []);
    }
}