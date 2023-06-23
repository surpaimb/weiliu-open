<?php

namespace Weiliu\Open\Chaty\Robot\Messages;

/**
 * 获取用户个人二维码
 *
 * Class RobotQrCodeMessage
 *
 * @package Weiliu\Open\Chaty\Robot\Messages
 */
class RobotQrCodeMessage extends Message
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setEvent('robot');
        $this->setType('qrcode');
        $this->setOs('ipad');
        $this->setData([]);
        $this->attributes = [];
    }
}