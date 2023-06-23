<?php

namespace Weiliu\Open\Chaty\Robot\Messages;

/**
 * 修改用户头像
 *
 * Class UserProfileModifyAvatarMessage
 *
 * @package Weiliu\Open\Chaty\Robot\Messages
 */
class UserProfileModifyAvatarMessage extends Message
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setEvent('user_profile');
        $this->setType('modify_avatar');
        $data = [
            'image' => $this->get('avatar', '')
        ];
        $this->setData($data);
        $this->attributes = [];
    }
}