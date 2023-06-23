<?php

namespace Weiliu\Open\WorkPhone\WsEvenets;

/**
 * 发送企业微信小程序任务
 */
class SendWeworkMiniTask extends WsEvent
{
    protected $appId;
    protected $xcxId;
    protected $sendNick;
    protected $title;
    protected $appName;
    protected $iconUrl;
    protected $imageUrl;
    protected $path;
    protected $versionType;

    public function __construct(
        $appId,
        $xcxId,
        $sendNick,
        $title,
        $imageUrl,
        $path,
        $appName,
        $iconUrl,
        $versionType = 0
    )
    {
        $this->appId = $appId;
        $this->xcxId = $xcxId;
        $this->sendNick = $sendNick;
        $this->title = $title;
        $this->appName = $appName;
        $this->iconUrl = $iconUrl;
        $this->imageUrl = $imageUrl;
        $this->path = $path;
        $this->versionType = $versionType;
    }

    public function event()
    {
        return 'send_wework_task';
    }

    public function data()
    {
        return [
            'type' => 'send_wework_mini_proc',
            'data' => [
                'appId' => $this->appId, // appid
                'xcxId' => $this->xcxId, // 小程序id 举例:"gh_7a5c4141778f@app"
                'sendNick' => $this->sendNick, // 发送的微信id 举例:"binbin594738977"
                'title' => $this->title, // 发送的标题 举例:"萌猫送福利，速来领取！喵"
                'appName' => $this->appName,
                'iconUrl' => $this->iconUrl,
                'imageUrl' => $this->imageUrl, // 封面的图片的路径 	举例:"http://xxx.jpg"
                'path' => $this->path, // 小程序path 举例:"pages/index/index.html?xxx"
                'versionType' => $this->versionType, // 0: RELEASE 1: DEVELOP 2: TRIAL
            ],
        ];
    }
}