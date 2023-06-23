<?php

namespace Weiliu\Open\Chaty\Robot\Messages;

/**
 * 退出登录
 *
 * Class LogoutLogoutMessage
 *
 * @package Weiliu\Open\Chaty\Robot\Messages
 */
class LogoutLogoutMessage extends Message
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setEvent('logout');
        $this->setType('logout');
        $this->setData([]);
        $this->attributes = [];
    }
}