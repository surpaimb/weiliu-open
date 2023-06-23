<?php

namespace Weiliu\Open\Chaty\Robot;

use Weiliu\Open\Chaty\BaseClient;

/**
 * 机器人身份验证部分
 */
class AuthClient extends BaseClient
{
    /**
     * 获取机器人登录二维码
     *
     * @param string|int $id 机器人 id 或者 unionid
     * @param string $uuid 唯一id，为空则随机生成一个uuid4
     * @param bool $sync 是否同步获取
     *
     * @return array|object|\Psr\Http\Message\ResponseInterface|string|\Weiliu\Open\Kernel\Support\Collection
     */
    public function qrcode($id = null, string $uuid = null, bool $sync = false)
    {
        return $this->httpGet('robots/auth/qrcode', [
            'id' => $id,
            'uuid' => $uuid,
            'sync' => $sync ? 1 : 0
        ]);
    }

    /**
     * 机器人退出登录
     *
     * @param string|int $id 机器人 id 或者 unionid
     *
     * @return array|object|\Psr\Http\Message\ResponseInterface|string|\Weiliu\Open\Kernel\Support\Collection
     */
    public function logout($id)
    {
        return $this->httpPost("robots/{$id}/auth/logout");
    }
}