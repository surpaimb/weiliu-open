<?php

namespace Weiliu\Open\Chaty\Device\Messages;

/**
 * 安卓切换机器人沙箱
 *
 * Class ChangerobotMessage
 *
 * @package Weiliu\Open\Chaty\Device\Messages
 */
class ChangerobotMessage extends Message
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setEvent('changerobot');
        $this->setOs('android');
        $this->setData([
            'wxnumber' => $this->get('wxnumber'),
        ]);
        $this->attributes = [];
    }
}