<?php

namespace Weiliu\Open\Chaty\Robot\Messages;

/**
 * 图片消息
 *
 * Class MessageImageMessage
 *
 * @package Weiliu\Open\Chaty\Robot\Messages
 */
class MessageImageMessage extends Message
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setEvent('message');
        $this->setType('image');
        $this->setOs($this->get('os', 'ipados'));
        $this->setData([
            'image' => $this->get('image'),
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