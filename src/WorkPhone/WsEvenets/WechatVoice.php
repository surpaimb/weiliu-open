<?php

namespace Weiliu\Open\WorkPhone\WsEvenets;

/**
 * 上报语音
 */
class WechatVoice extends WsEvent
{
    protected $imgPath;
    protected $msgSvrId;

    public function __construct($imgPath, $msgSvrId)
    {
        $this->imgPath = $imgPath;
        $this->msgSvrId = $msgSvrId;
    }

    public function event()
    {
        return 'wechat_voice';
    }

    public function data()
    {
        return [
            'imgPath' => $this->imgPath,
            'msgSvrId' => $this->msgSvrId,
        ];
    }
}