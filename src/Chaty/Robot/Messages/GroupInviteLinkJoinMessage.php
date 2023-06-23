<?php

namespace Weiliu\Open\Chaty\Robot\Messages;

/**
 * ipados 进群
 *
 * Class GroupInviteLinkJoinMessage
 *
 * @package Weiliu\Open\Chaty\Robot\Messages
 */
class GroupInviteLinkJoinMessage extends Message
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setEvent('group');
        $this->setType('invite_link_join');
        $this->setOs('ipados');
        $this->setData([
            'url' => (string)$this->get('url'),
            'wxid' => (string)$this->get('wxid'),
        ]);
        $this->attributes = [];
    }
}