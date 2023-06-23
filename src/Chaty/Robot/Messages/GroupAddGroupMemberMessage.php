<?php

namespace Weiliu\Open\Chaty\Robot\Messages;

/**
 * android 邀请进群
 *
 * Class GroupEnterBigGroupMessage
 *
 * @package Weiliu\Open\Chaty\Robot\Messages
 */
class GroupAddGroupMemberMessage extends Message
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setEvent('group');
        $this->setType('AddGroupMember');
        $this->setOs('android');
        $this->setData([
            'group_id' => $this->get('roomid'),
            'members' => $this->get('wxids'),
        ]);
        $this->attributes = [];
    }
}