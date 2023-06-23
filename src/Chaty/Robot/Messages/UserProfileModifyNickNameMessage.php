<?php

namespace Weiliu\Open\Chaty\Robot\Messages;

/**
 * 修改用户昵称
 *
 * Class UserProfileModifyNickNameMessage
 *
 * @package Weiliu\Open\Chaty\Robot\Messages
 */
class UserProfileModifyNickNameMessage extends Message
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setEvent('user_profile');
        $this->setType('modify_nickname');
        $data = [
            'nickname' => $this->get('nickname', '')
        ];
        $this->setData($data);
        $this->attributes = [];
    }
}