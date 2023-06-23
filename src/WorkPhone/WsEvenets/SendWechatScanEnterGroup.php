<?php

namespace Weiliu\Open\WorkPhone\WsEvenets;

/**
 * 扫码入群
 */
class SendWechatScanEnterGroup extends WsEvent
{
    protected $imageUrl;

    public function __construct($imageUrl)
    {
        $this->imageUrl = $imageUrl;
    }

    public function event()
    {
        return 'send_wechat_task';
    }

    public function data()
    {
        return [
            'type' => 'scan_enter_group',
            'data' => [
                'imageUrl' => $this->imageUrl,
            ]
        ];
    }
}