<?php

namespace Weiliu\Open\WorkPhone\WsEvenets;

/**
 * 上报微信的视频
 */
class WechatVideo extends WsEvent
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
        return 'wechat_video';
    }

    public function data()
    {
        return [
            'imgPath' => $this->imgPath,
            'msgSvrId' => $this->msgSvrId,
        ];
    }
}