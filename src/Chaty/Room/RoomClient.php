<?php

namespace Weiliu\Open\Chaty\Room;

use Weiliu\Open\Chaty\BaseClient;

/**
 * 群部分
 */
class RoomClient extends BaseClient
{
    /**
     * 群列表
     *
     * @param int $page 当前页
     * @param int $perPage 每页条数
     * @param array $query
     *
     * @return \Psr\Http\Message\ResponseInterface|\Weiliu\Open\Kernel\Support\Collection|array|object|string
     */
    public function list(int $page = 1, int $perPage = 20, $query = [])
    {
        $query += [
            'sort_by' => 'created_at',
            'descending' => 'desc',
            'page' => $page,
            'per_page' => $perPage,
        ];

        return $this->httpGet('rooms', $query);
    }

    /**
     * 机器人所属人下的群列表
     *
     * @param int|string $profileId 第三方用户 id 或者 unionid
     * @param int $page
     * @param int $perPage
     * @param array $query
     *
     * @return array|object|\Psr\Http\Message\ResponseInterface|string|\Weiliu\Open\Kernel\Support\Collection
     */
    public function listByRobotProfile($profileId, int $page = 1, int $perPage = 20, $query = [])
    {
        return $this->list($page, $perPage, array_merge($query, [
            'profile_id' => $profileId
        ]));
    }

    /**
     * 查询单个群
     *
     * @param string|int $id 群 id 或者 roomid
     * @param array $with 需要一起获取的关系
     *
     * @return array|object|\Psr\Http\Message\ResponseInterface|string|\Weiliu\Open\Kernel\Support\Collection
     */
    public function find($id, $with = [])
    {
        $query = [];

        if ($with) {
            $query['include'] = implode(',', $with);
        }

        return $this->httpGet("rooms/{$id}", $query);
    }
}