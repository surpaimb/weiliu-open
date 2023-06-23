<?php

namespace Weiliu\Open\Chaty\Device;

use Weiliu\Open\Chaty\Device\Messages\Message;
use Weiliu\Open\Chaty\BaseClient;

/**
 * 设备
 */
class DeviceClient extends BaseClient
{
    /**
     * 设备列表
     *
     * @param int $page 当前页
     * @param int $perPage 每页条数
     * @param array $query
     *
     * @return array|object|\Psr\Http\Message\ResponseInterface|string|\Weiliu\Open\Kernel\Support\Collection
     */
    public function list(int $page = 1, int $perPage = 20, $query = [])
    {
        $query += [
            'sort_by' => 'created_at',
            'descending' => 'desc',
            'page' => $page,
            'per_page' => $perPage,
        ];

        return $this->httpGet('devices', $query);
    }

    /**
     * 查询单个设备
     *
     * @param string|int $id 设备 id 或者 deviceid
     * @param array $with
     *
     * @return array|object|\Psr\Http\Message\ResponseInterface|string|\Weiliu\Open\Kernel\Support\Collection
     */
    public function find($id, array $with = [])
    {
        $query = [];

        if ($with) {
            $query['include'] = implode(',', $with);
        }

        return $this->httpGet("devices/{$id}", $query);
    }

    /**
     * 下发指令
     *
     * @param string|int $id 设备 id 或者 deviceid
     * @param Message $message
     *
     * @return array|object|\Psr\Http\Message\ResponseInterface|string|\Weiliu\Open\Kernel\Support\Collection
     */
    public function sendMessage($id, Message $message)
    {
        return $this->httpPost("devices/{$id}/messages", $message->toArray());
    }
}