<?php

namespace Weiliu\Open\WorkPhone\WsEvenets;

/**
 * 微信缩略图片
 */
class WechatImageTh extends WsEvent
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
        return 'wechat_image_th';
    }

    public function data()
    {
        return [
            'imgPath' => $this->imgPath,
            'msgSvrId' => $this->msgSvrId,
        ];
    }
}