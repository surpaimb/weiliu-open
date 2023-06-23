<?php

namespace Weiliu\Open\Chaty\Robot\Messages;

/**
 * android 进群
 *
 * Class GroupEnterBigGroupMessage
 *
 * @package Weiliu\Open\Chaty\Robot\Messages
 */
class GroupEnterBigGroupMessage extends Message
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setEvent('group');
        $this->setType('enter_big_group');
        $this->setOs('android');
        $this->setData([
            'rawUrl' => $this->get('url'),
            'sendWxId' => $this->get('wxid'),
        ]);
        $this->attributes = [];
    }
}