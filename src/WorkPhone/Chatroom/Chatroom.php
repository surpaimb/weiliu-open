<?php

namespace Weiliu\Open\WorkPhone\Chatroom;

use Weiliu\Open\WorkPhone\BaseClient;

class Chatroom extends BaseClient
{
    /**
     * 客户群列表
     *
     * @param array $query
     *
     * @return array
     */
    public function list(array $query = [])
    {
        return $this->httpGet('/chatrooms', $query);
    }

    /**
     * 客户群成员列表
     *
     * @param $id
     * @param array $query
     *
     * @return array
     */
    public function friends($id, array $query = [])
    {
        return $this->httpGet("/chatrooms/{$id}/friends", $query);
    }
}