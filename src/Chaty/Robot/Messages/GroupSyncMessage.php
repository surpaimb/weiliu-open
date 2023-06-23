<?php

namespace Weiliu\Open\Chaty\Robot\Messages;

/**
 * 下发群同步指令
 *
 * Class GroupSyncMessage
 *
 * @package Weiliu\Open\Chaty\Robot\Messages
 */
class GroupSyncMessage extends Message
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setEvent('group');
        $this->setType('sync');
        $data = [];
        if ($this->has('roomid')) {
            $data['room_id'] = $this->get('roomid');
        }
        $this->setData($data);
        $this->attributes = [];
    }
}