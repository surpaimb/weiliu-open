<?php

namespace Weiliu\Open\WorkPhone\WsEvenets;

/**
 * 发送微信重新发单任务
 */
class SendWechatRestartTask extends WsEvent
{
    public function event()
    {
        return 'send_wechat_task';
    }

    public function data()
    {
        return [
            'type' => 'task_restart',
            'data' => (object)[],
        ];
    }
}