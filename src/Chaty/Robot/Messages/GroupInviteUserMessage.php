<?php

namespace Weiliu\Open\Chaty\Robot\Messages;

/**
 * ipados 邀请进群
 *
 * Class GroupInviteUserMessage
 *
 * @package Weiliu\Open\Chaty\Robot\Messages
 */
class GroupInviteUserMessage extends Message
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setEvent('group');
        $this->setType('invite_user');
        $this->setOs('ipados');
        $this->setData([
            'room_id' => (string)$this->get('roomid'),
            'wxid' => (string)$this->get('wxid'),
        ]);
        $this->attributes = [];
    }
}