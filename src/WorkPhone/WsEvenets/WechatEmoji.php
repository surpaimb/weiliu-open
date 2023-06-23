<?php

namespace Weiliu\Open\WorkPhone\WsEvenets;

/**
 * 上报自定义表情
 */
class WechatEmoji extends WsEvent
{
    protected $msgSvrId;
    protected $fieldGroupId;
    protected $fieldMd5;

    public function __construct($msgSvrId, $fieldGroupId, $fieldMd5)
    {
        $this->msgSvrId = $msgSvrId;
        $this->fieldGroupId = $fieldGroupId;
        $this->fieldMd5 = $fieldMd5;
    }

    public function event()
    {
        return 'wechat_emoji';
    }

    public function data()
    {
        return [
            'msgSvrId' => $this->msgSvrId,
            'fieldGroupId' => $this->fieldGroupId,
            'fieldMd5' => $this->fieldMd5,
        ];
    }
}