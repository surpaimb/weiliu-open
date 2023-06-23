<?php

namespace Weiliu\Open\WorkPhone\WsEvenets;

/**
 * 上报微信的视频封面
 */
class WechatVideoCover extends WsEvent
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
        return 'wechat_video_cover';
    }

    public function data()
    {
        return [
            'imgPath' => $this->imgPath,
            'msgSvrId' => $this->msgSvrId,
        ];
    }
}
