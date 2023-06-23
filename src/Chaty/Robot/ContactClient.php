<?php

namespace Weiliu\Open\Chaty\Robot;

use Weiliu\Open\Chaty\BaseClient;

/**
 * 机器人联系人部分
 */
class ContactClient extends BaseClient
{
    /**
     * 发送好友申请
     *
     * @param string|int $id 机器人 id 或者 unionid
     * @param string $search 搜索值
     * @param string $remark 备注
     * @param string $type wxnumber 或者 deleted 或者 mobile
     *
     * @return array|object|\Psr\Http\Message\ResponseInterface|string|\Weiliu\Open\Kernel\Support\Collection
     */
    public function sendApplication($id, string $search, string $remark = '你好', string $type = 'wxnumber')
    {
        return $this->httpPost("robots/{$id}/contacts", [
            'search' => $search,
            'remark' => $remark,
            'type' => $type,
        ]);
    }

    /**
     * 发送消息
     *
     * @param string|int $id 机器人 id 或者 unionid
     * @param string|int $contactId 联系人 id 或者 unionid
     * @param $message
     *
     * @return array|object|\Psr\Http\Message\ResponseInterface|string|\Weiliu\Open\Kernel\Support\Collection
     */
    public function sendMessage($id, $contactId, array $message)
    {
        return $this->httpPost("robots/{$id}/contacts/{$contactId}/messages", $message);
    }


    /**
     * 发送联系人文字消息
     *
     * @param string|int $id 机器人 id 或者 unionid
     * @param string|int $contactId 联系人 id 或者 unionid
     * @param string $text
     *
     * @return array|object|\Psr\Http\Message\ResponseInterface|string|\Weiliu\Open\Kernel\Support\Collection
     */
    public function sendTextMessage($id, $contactId, string $text)
    {
        return $this->sendMessage($id, $contactId, [
            'type' => 'text',
            'text' => $text
        ]);
    }

    /**
     * 发送联系人图片消息
     *
     * @param string|int $id 机器人 id 或者 unionid
     * @param string|int $contactId 联系人 id 或者 unionid
     * @param string $image
     *
     * @return array|object|\Psr\Http\Message\ResponseInterface|string|\Weiliu\Open\Kernel\Support\Collection
     */
    public function sendImageMessage($id, $contactId, string $image)
    {
        return $this->sendMessage($id, $contactId, [
            'type' => 'image',
            'image' => $image
        ]);
    }

    /**
     * 发送联系人链接消息
     *
     * @param string|int $id 机器人 id 或者 unionid
     * @param string|int $contactId 联系人 id 或者 unionid
     * @param string $title
     * @param string $desc
     * @param string $image
     * @param string $link
     *
     * @return array|object|\Psr\Http\Message\ResponseInterface|string|\Weiliu\Open\Kernel\Support\Collection
     */
    public function sendLinkMessage($id, $contactId, string $title, string $desc, string $image, string $link)
    {
        return $this->sendMessage($id, $contactId, [
            'type' => 'link',
            'title' => $title,
            'desc' => $desc,
            'image' => $image,
            'link' => $link,
        ]);
    }

    /**
     * 发送联系人视频消息
     *
     * @param string|int $id 机器人 id 或者 unionid
     * @param string|int $contactId 联系人 id 或者 unionid
     * @param string $videoUrl
     * @param string $videoWidth
     * @param string $videoHeight
     * @param $duration
     * @param string $imageUrl
     *
     * @return array|object|\Psr\Http\Message\ResponseInterface|string|\Weiliu\Open\Kernel\Support\Collection
     */
    public function sendVideoMessage($id, $contactId, string $videoUrl, string $videoWidth, string $videoHeight, $duration, string $imageUrl)
    {
        return $this->sendMessage($id, $contactId, [
            'type' => 'video',
            'video_url' => $videoUrl,
            'video_width' => $videoWidth,
            'video_height' => $videoHeight,
            'duration' => $duration,
            'image_url' => $imageUrl,
        ]);
    }
}