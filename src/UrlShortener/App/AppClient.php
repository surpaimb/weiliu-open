<?php

namespace Weiliu\Open\UrlShortener\App;

use Weiliu\Open\UrlShortener\BaseClient;

class AppClient extends BaseClient
{
    /**
     * @param array $data
     *
     * @return array|null|string
     */
    public function create(array $data)
    {
        if (isset($data['base_uris'])) {
            $data['base_uris'] = implode(',', $data['base_uris']);
        }

        return $this->httpPost('/v1/apps', $data);
    }

    /**
     * @return array|null|string
     */
    public function find()
    {
        $appid = $this->app->config->get('appid');

        return $this->httpGet("/v1/apps/{$appid}");
    }

    /**
     * @param array $data
     *
     * @return array|null|string
     */
    public function update(array $data)
    {
        if (isset($data['base_uris'])) {
            $data['base_uris'] = implode(',', $data['base_uris']);
        }

        $appid = $this->app->config->get('appid');

        return $this->httpPost("/v1/apps/{$appid}", $data);
    }
}