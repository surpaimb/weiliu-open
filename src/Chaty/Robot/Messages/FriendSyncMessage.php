<?php

namespace Weiliu\Open\Chaty\Robot\Messages;

/**
 * 下发好友同步指令
 *
 * Class FriendSyncMessage
 *
 * @package Weiliu\Open\Chaty\Robot\Messages
 */
class FriendSyncMessage extends Message
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setEvent('friend');
        $this->setType('sync');
        $this->setOs($this->get('os', 'ipados'));
        $data = [];
        switch ($this->os) {
            case 'ipados':
                if ($wxids = $this->get('wxids')) {
                    $data['wxids'] = (array)$wxids;
                }
                break;
        }
        $this->setData($data);
        $this->attributes = [];
    }
}