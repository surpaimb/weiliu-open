<?php

namespace Weiliu\Open\WorkPhone\WsEvenets;

/**
 * 收藏（置顶）微信群
 */
class CollectWechatGroup extends WsEvent
{
    protected $groupName;

    public function __construct($groupName)
    {
        $this->groupName = $groupName;
    }

    public function event()
    {
        return 'send_wechat_task';
    }

    public function data()
    {
        return [
            'type' => 'collect_group',
            'data' => [
                'groupName' => $this->groupName,
            ],
        ];
    }
}