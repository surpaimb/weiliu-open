<?php

namespace Weiliu\Open\Chaty\Robot;

use Weiliu\Open\Chaty\Robot\Messages\Message;
use Weiliu\Open\Chaty\BaseClient;

/**
 * 机器人客户端
 */
class Client extends BaseClient
{
    /**
     * 机器人列表
     *
     * @param int $page 当前页
     * @param int $perPage 每页条数
     * @param array $query 额外的查询条件
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
            'include' => 'profile'
        ];

        return $this->httpGet('robots', $query);
    }

    /**
     * 查询机器人
     *
     * @param string|int $id 机器人 id 或者 unionid
     * @param string $os 操作系统类型 ipados/android
     * @param array $with 需要一起获取的关系
     *
     * @return array|object|\Psr\Http\Message\ResponseInterface|string|\Weiliu\Open\Kernel\Support\Collection
     */
    public function find($id, string $os = 'ipados', $with = ['profile'])
    {
        $query = [
            'os' => $os,
        ];

        if ($with) {
            $query['include'] = implode(',', $with);
        }

        return $this->httpGet("robots/{$id}", $query);
    }

    /**
     * 下发指令
     *
     * @param string|int $id 机器人 id 或者 unionid
     * @param Message $message
     *
     * @return array|object|\Psr\Http\Message\ResponseInterface|string|\Weiliu\Open\Kernel\Support\Collection
     */
    public function sendMessage($id, Message $message)
    {
        return $this->httpPost("robots/{$id}/messages", $message->toArray());
    }
}