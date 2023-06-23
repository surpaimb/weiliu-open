<?php

namespace Weiliu\Open\WorkPhone\WsEvenets;

/**
 * 发送微信小程序任务
 */
class SendWechatMiniTask extends WsEvent
{
    protected $appId;
    protected $xcxId;
    protected $sendWxId;
    protected $sendNick;
    protected $sendGrop;
    protected $title;
    protected $imageUrl;
    protected $path;
    protected $versionType;

    public function __construct(
        $appId,
        $xcxId,
        $sendWxId,
        $sendNick,
        $sendGrop,
        $title,
        $imageUrl,
        $path,
        $versionType = 0
    )
    {
        $this->appId = $appId;
        $this->xcxId = $xcxId;
        $this->sendWxId = $sendWxId;
        $this->sendNick = $sendNick;
        $this->sendGrop = $sendGrop;
        $this->title = $title;
        $this->imageUrl = $imageUrl;
        $this->path = $path;
        $this->versionType = $versionType;
    }

    public function event()
    {
        return 'send_wechat_task';
    }

    public function data()
    {
        return [
            'type' => 'send_mini_proc',
            'data' => [
                'appId' => $this->appId, // appid
                'xcxId' => $this->xcxId, // 小程序id 举例:"gh_7a5c4141778f@app"
                'sendWxId' => $this->sendWxId, // 发送的微信id 举例:"binbin594738977"
                'sendNick' => $this->sendNick, // 发送的昵称 举例:"测试群添加"
                'sendGrop' => $this->sendGrop, // 是否是群聊 举例:true
                'title' => $this->title, // 发送的标题 举例:"萌猫送福利，速来领取！喵"
                'imageUrl' => $this->imageUrl, // 封面的图片的路径 	举例:"http://xxx.jpg"
                'path' => $this->path, // 小程序path 举例:"pages/index/index.html?xxx"
                'versionType' => $this->versionType, // 0: RELEASE 1: DEVELOP 2: TRIAL
            ],
        ];
    }
}