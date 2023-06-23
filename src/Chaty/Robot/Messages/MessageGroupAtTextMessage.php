<?php

namespace Weiliu\Open\Chaty\Robot\Messages;

/**
 * 文字消息-群at文字消息
 *
 * Class MessageGroupAtTextMessage
 *
 * @package Weiliu\Open\Chaty\Robot\Messages
 */
class MessageGroupAtTextMessage extends Message
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setEvent('message');
        $this->setType('group_at_text');
        $this->setOs('ipados');
        $nick = (string)$this->get('nick');
        $text = (string)$this->get('text');
        $this->setData([
            'content' => "@{$nick} {$text}",
            'at_user' => (string)$this->get('wxid'),
            'room_id' => (string)$this->get('roomid'),
        ]);
        $this->attributes = [];
    }
}