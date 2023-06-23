<?php

namespace Weiliu\Open\Chaty\Robot\Messages;

/**
 * 文字消息
 *
 * Class MessageTextMessage
 *
 * @package Weiliu\Open\Chaty\Robot\Messages
 */
class MessageTextMessage extends Message
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setEvent('message');
        $this->setType('text');
        $this->setOs($this->get('os', 'ipados'));
        $this->setData([
            'text' => $this->get('text'),
        ]);
        switch ($this->os) {
            case 'ipados':
                $this->attributes = [
                    'wxid' => $this->get('wxid')
                ];
                break;
            default:
                $this->attributes = [
                    'wxid' => $this->get('wxid')
                ];
                break;
        }
    }
}