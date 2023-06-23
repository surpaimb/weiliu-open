<?php

namespace Weiliu\Open\WorkPhone\WsEvenets;

/**
 * 发送微信任务包
 */
class SendWechatPackTask extends WsEvent
{
    protected $list;

    public function __construct($list)
    {
        $this->list = $list;
    }

    public function event()
    {
        return 'send_wechat_task';
    }

    public function data()
    {
        return [
            'type' => 'group_task_pack',
            'data' => [
                'list' => $this->list,
            ],
        ];
    }
}