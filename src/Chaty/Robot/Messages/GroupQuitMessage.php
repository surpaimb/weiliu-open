<?php

namespace Weiliu\Open\Chaty\Robot\Messages;

/**
 * 退群
 *
 * Class GroupQuitMessage
 *
 * @package Weiliu\Open\Chaty\Robot\Messages
 */
class GroupQuitMessage extends Message
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setEvent('group');
        $this->setType('quit');
        $this->setData([
            'room_id' => (string)$this->get('roomid')
        ]);
        $this->attributes = [];
    }
}