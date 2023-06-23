<?php

namespace Weiliu\Open\WorkPhone\WsEvenets;

/**
 * 发送企业微信图文消息任务
 */
class SendWeworkTextTask extends WsEvent
{
    protected $sendNick;
    protected $sendGrop;
    protected $sendItems;

    public function __construct($sendNick, $sendGrop, $sendItems)
    {
        $this->sendNick = $sendNick;
        $this->sendGrop = $sendGrop;
        $this->sendItems = $sendItems;
    }

    public function event()
    {
        return 'send_wework_task';
    }

    public function data()
    {
        return [
            'type' => 'send_wework_msg',
            'data' => [
                'sendNick' => $this->sendNick, // 发送的昵称 举例:"测试群添加"
                'sendGrop' => $this->sendGrop, // 是否是群聊 举例:true
                'sendItems' => $this->sendItems, // 发送消息item 举例:[{sendType:1,sendData:"文本消息"},{sendType:2,sendData:"http://xxx"}] 类型1是文本消息, 类型2是图片消息
            ],
        ];
    }
}