<?php

namespace Weiliu\Open\Chaty\Robot\Messages;

/**
 * 安卓识别二维码登录
 *
 * Class RobotAuthorizationLoginMessage
 *
 * @package Weiliu\Open\Chaty\Robot\Messages
 */
class RobotAuthorizationLoginMessage extends Message
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setEvent('robot');
        $this->setType('authorization_login');
        $this->setOs('android');
        $this->setData([
            'qrcode' => $this->get('qrcode')
        ]);
        $this->attributes = [];
    }
}