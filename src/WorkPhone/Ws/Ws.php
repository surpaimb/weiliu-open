<?php

namespace Weiliu\Open\WorkPhone\Ws;

use Weiliu\Open\WorkPhone\BaseClient;
use Weiliu\Open\WorkPhone\WsEvenets\WsEvent;

class Ws extends BaseClient
{
    /**
     * ws 消息推送
     *
     * @param string $username 微信ID或者微信号
     * @param array|WsEvent $event 事件
     *
     * @return array
     */
    public function post(string $username, $event)
    {
        if ($event instanceof WsEvent) {
            $event = $event->toArray();
        }

        return $this->httpPostJson('/devices/ws', [
            'username' => $username,
            'event' => (array)$event
        ]);
    }
}