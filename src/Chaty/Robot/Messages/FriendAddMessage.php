<?php

namespace Weiliu\Open\Chaty\Robot\Messages;

/**
 * 加好友
 *
 * Class FriendAddMessage
 *
 * @package Weiliu\Open\Chaty\Robot\Messages
 */
class FriendAddMessage extends Message
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setEvent('friend');
        $this->setType('add');
        $this->setOs($this->get('os', 'ipados'));
        switch ($this->os) {
            case 'ipados':
                // 3:全新通过微信号搜索添加好友
                // 6:被删除之后通过微信号添加好友
                // 15:手机方式添加好友指令
                switch ($type = $this->get('type', 'wxnumber')) {
                    case 'wxnumber':
                        $type = 3;
                        break;
                    case 'deleted':
                        $type = 6;
                        break;
                    case 'mobile':
                        $type = 15;
                        break;
                }
                $this->setData([
                    'textType' => $type,
                    'searchText' => $this->get('search'),
                    'tip' => $this->get('remark', '你好'),
                ]);
                break;
        }
        $this->attributes = [];
    }
}