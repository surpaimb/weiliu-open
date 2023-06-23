<?php

namespace Weiliu\Open\Chaty\RoomContact;

use Weiliu\Open\Chaty\BaseClient;

/**
 * 群联系人
 */
class RoomContactClient extends BaseClient
{
    /**
     * 联系人列表
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
            'include' => 'profile'
        ];

        return $this->httpGet('room_contacts', $query);
    }

    /**
     * 所属群下的群联系人列表
     *
     * @param int|string $roomId 群 id 或者 roomid
     * @param int $page
     * @param int $perPage
     * @param array $query
     *
     * @return array|object|\Psr\Http\Message\ResponseInterface|string|\Weiliu\Open\Kernel\Support\Collection
     */
    public function listByRoom($roomId, int $page = 1, int $perPage = 20, $query = [])
    {
        return $this->list($page, $perPage, array_merge($query, [
            'room_id' => $roomId
        ]));
    }

    /**
     * 查询单个群联系人
     *
     * @param string|int $id 群联系人 id 或者 unionid
     * @param array $with
     *
     * @return array|object|\Psr\Http\Message\ResponseInterface|string|\Weiliu\Open\Kernel\Support\Collection
     */
    public function find($id, array $with = ['profile'])
    {
        $query = [];

        if ($with) {
            $query['include'] = implode(',', $with);
        }

        return $this->httpGet("room_contacts/{$id}", $query);
    }
}