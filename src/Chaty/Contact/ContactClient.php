<?php

namespace Weiliu\Open\Chaty\Contact;

use Weiliu\Open\Chaty\BaseClient;

/**
 * 联系人
 */
class ContactClient extends BaseClient
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

        return $this->httpGet('contacts', $query);
    }

    /**
     * 机器人所属人下的联系人列表
     *
     * @param int|string $profileId - 第三方用户 id 或者 unionid
     * @param int $page
     * @param int $perPage
     * @param array $query
     *
     * @return array|object|\Psr\Http\Message\ResponseInterface|string|\Weiliu\Open\Kernel\Support\Collection
     */
    public function listByRobotProfile($profileId, int $page = 1, int $perPage = 20, $query = [])
    {
        return $this->list($page, $perPage, array_merge($query, [
            'robot_profile_id' => $profileId
        ]));
    }

    /**
     * 查询单个联系人
     *
     * @param string|int $id 联系人 id 或者 unionid
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

        return $this->httpGet("contacts/{$id}", $query);
    }
}