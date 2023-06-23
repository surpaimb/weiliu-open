<?php

namespace Weiliu\Open\WorkPhone\WsEvenets;

/**
 * 微信高清图片
 */
class WechatImageHd extends WsEvent
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
        return 'wechat_image_hd';
    }

    public function data()
    {
        return [
            'imgPath' => $this->imgPath,
            'msgSvrId' => $this->msgSvrId,
        ];
    }
}