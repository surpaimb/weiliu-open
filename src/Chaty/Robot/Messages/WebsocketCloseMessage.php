<?php

namespace Weiliu\Open\Chaty\Robot\Messages;

/**
 * 退出与客户端的通讯连接，非客户端自有消息
 *
 * Class WebsocketCloseMessage
 *
 * @package Weiliu\Open\Chaty\Robot\Messages
 */
class WebsocketCloseMessage extends Message
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setEvent('websocket');
        $this->setType('close');
        $this->setData([]);
        $this->id = null;
        $this->attributes = [];
    }
}