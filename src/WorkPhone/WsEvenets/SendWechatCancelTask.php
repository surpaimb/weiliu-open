<?php

namespace Weiliu\Open\WorkPhone\WsEvenets;

/**
 * 发送微信取消发单任务
 */
class SendWechatCancelTask extends WsEvent
{
    public function event()
    {
        return 'send_wechat_task';
    }

    public function data()
    {
        return [
            'type' => 'task_all_cancel',
            'data' => (object)[],
        ];
    }
}