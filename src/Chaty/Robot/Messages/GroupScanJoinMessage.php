<?php

namespace Weiliu\Open\Chaty\Robot\Messages;

/**
 * 扫码入群
 *
 * Class GroupScanJoinMessage
 *
 * @package Weiliu\Open\Chaty\Robot\Messages
 */
class GroupScanJoinMessage extends Message
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setEvent('group');
        $this->setType('scan_join');
        $this->setOs('ipados');
        $this->setData([
            'code_url' => (string)$this->get('qrcode'),
        ]);
        $this->attributes = [];
    }
}