<?php

namespace Weiliu\Open\Chaty\Robot\Messages;

/**
 * 建群
 *
 * Class GroupCreateChatroomMessage
 *
 * @package Weiliu\Open\Chaty\Robot\Messages
 */
class GroupCreateChatroomMessage extends Message
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setEvent('group');
        $this->setType('create_chatroom');
        $this->setOs('ipados');
        $this->setData([
            'wxids' => (array)$this->get('wxids'),
            'name' => (string)$this->get('name'),
            'uuid' => (string)$this->get('uuid'),
        ]);
        $this->attributes = [];
    }
}