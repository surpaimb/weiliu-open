<?php

namespace Weiliu\Open\Chaty\Robot\Messages;

/**
 * 群消息免打
 *
 * Class GroupNotifyOffMessage
 *
 * @package Weiliu\Open\Chaty\Robot\Messages
 */
class GroupNotifyOffMessage extends Message
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setEvent('group');
        $this->setType('notify_off');
        $this->setOs($this->get('os', 'ipados'));
        $this->setData([
            'room_id' => (string)$this->get('roomid')
        ]);
        $this->attributes = [];
    }
}