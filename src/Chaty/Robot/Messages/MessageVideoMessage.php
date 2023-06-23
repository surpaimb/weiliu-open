<?php

namespace Weiliu\Open\Chaty\Robot\Messages;

/**
 * 视频消息
 *
 * Class MessageVideoMessage
 *
 * @package Weiliu\Open\Chaty\Robot\Messages
 */
class MessageVideoMessage extends Message
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setEvent('message');
        $this->setType('video');
        $this->setData([
            'videoUrl' => $this->get('videoUrl'),
            'videoWidth' => $this->get('videoWidth'),
            'videoHeight' => $this->get('videoHeight'),
            'duration' => $this->get('duration'),
            'imageUrl' => $this->get('imageUrl'),
            'wxid' => $this->get('wxid'),
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