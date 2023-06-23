<?php

namespace Weiliu\Open\Chaty\Robot\Messages;

/**
 * 修改自己的群内昵称
 *
 * Class GroupChangeRoomNickMessage
 *
 * @package Weiliu\Open\Chaty\Robot\Messages
 */
class GroupChangeRoomNickMessage extends Message
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setEvent('group');
        $this->setType('change_room_nick');
        $this->setOs('ipados');
        $this->setData([
            'room_id' => (string)$this->get('roomid'),
            'nick' => (string)$this->get('nick'),
        ]);
        $this->attributes = [];
    }
}