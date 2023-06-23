<?php

namespace Weiliu\Open\WorkPhone\WsEvenets;

/**
 * 发送微信朋友圈任务
 */
class SendWechatCircleTask extends WsEvent
{
    protected $title;
    protected $images;

    public function __construct($title, $images)
    {
        $this->title = $title;
        $this->images = $images;
    }

    public function event()
    {
        return 'send_wechat_task';
    }

    public function data()
    {
        return [
            'type' => 'send_circle',
            'data' => [
                'title' => $this->title,
                'imageList' => $this->images,
            ],
        ];
    }
}