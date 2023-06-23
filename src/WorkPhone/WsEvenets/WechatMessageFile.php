<?php

namespace Weiliu\Open\WorkPhone\WsEvenets;

/**
 * 微信消息文件
 */
class WechatMessageFile extends WsEvent
{
    protected $fileName;
    protected $isSend;
    protected $msgSvrId;

    public function __construct($fileName, $isSend, $msgSvrId)
    {
        $this->fileName = $fileName;
        $this->isSend = $isSend;
        $this->msgSvrId = $msgSvrId;
    }

    public function event()
    {
        return 'wechat_message_file';
    }

    public function data()
    {
        return [
            'fileName' => $this->fileName,
            'isSend' => $this->isSend,
            'msgSvrId' => $this->msgSvrId,
        ];
    }
}