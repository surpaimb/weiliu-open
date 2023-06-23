<?php

namespace Weiliu\Open\Chaty\Robot\Messages;

/**
 * 链接消息
 *
 * Class MessageLinkMessage
 *
 * @package Weiliu\Open\Chaty\Robot\Messages
 */
class MessageLinkMessage extends Message
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setEvent('message');
        $this->setType('link');
        $this->setData([
            'link' => $this->get('link'),
            'toUser' => $this->get('toUser'),
            'image' => $this->get('image'),
            'title' => $this->get('title'),
            'desc' => $this->get('desc'),
        ]);
        $this->attributes = [];
    }
}