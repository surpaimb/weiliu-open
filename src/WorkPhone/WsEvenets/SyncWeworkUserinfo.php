<?php

namespace Weiliu\Open\WorkPhone\WsEvenets;

/**
 * 同步企业微信当前登录用户数据
 */
class SyncWeworkUserinfo extends WsEvent
{
    public function event()
    {
        return 'send_wework_task';
    }

    public function data()
    {
        return [
            'type' => 'upload_wework_login_msg',
            'data' => (object)[],
        ];
    }
}