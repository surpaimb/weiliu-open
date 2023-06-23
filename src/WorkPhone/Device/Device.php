<?php

namespace Weiliu\Open\WorkPhone\Device;

use Weiliu\Open\WorkPhone\BaseClient;

class Device extends BaseClient
{
    /**
     * 设备列表
     *
     * @param array $query
     *
     * @return array
     */
    public function list(array $query = [])
    {
        return $this->httpGet('/devices', $query);
    }
}