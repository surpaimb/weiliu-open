<?php

namespace Weiliu\Open\Chaty\Profile;

use Weiliu\Open\Chaty\BaseClient;

/**
 * 第三方用户部分
 *
 * 全局 profile 等同 user profile
 */
class ProfileClient extends BaseClient
{
    /**
     * 查询单个第三方用户
     *
     * @param string $id 第三方用户的 unionid 或 username (微信用户此处等于微信ID/微信号)
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

        return $this->httpGet("profiles/{$id}", $query);
    }
}