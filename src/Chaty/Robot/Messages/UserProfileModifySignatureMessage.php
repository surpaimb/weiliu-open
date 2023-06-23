<?php

namespace Weiliu\Open\Chaty\Robot\Messages;

/**
 * 修改用户签名
 *
 * Class UserProfileModifySignatureMessage
 *
 * @package Weiliu\Open\Chaty\Robot\Messages
 */
class UserProfileModifySignatureMessage extends Message
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setEvent('user_profile');
        $this->setType('modify_signature');
        $data = [
            'signature' => $this->get('signature', '')
        ];
        $this->setData($data);
        $this->attributes = [];
    }
}