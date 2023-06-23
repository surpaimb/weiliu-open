<?php

namespace Weiliu\Open\Chaty\Robot;

use Weiliu\Open\Chaty\BaseClient;

/**
 * 机器人群部分
 */
class RoomClient extends BaseClient
{
    /**
     * 创建或者加入
     *
     * @param string|int $id 机器人 id 或者 unionid
     * @param array $data
     *
     * @return array|object|\Psr\Http\Message\ResponseInterface|string|\Weiliu\Open\Kernel\Support\Collection
     */
    public function createOrJoin($id, array $data)
    {
        return $this->httpPost("robots/{$id}/rooms", $data);
    }

    /**
     * 机器人建群
     *
     * @param string|int $id 机器人 id 或者 unionid
     * @param array $contacts 机器人联系人 id 或者 unionid 数组
     * @param string $name 群名称
     * @param string $uuid 唯一id，为空则随机生成一个uuid4
     *
     * @return array|object|\Psr\Http\Message\ResponseInterface|string|\Weiliu\Open\Kernel\Support\Collection
     */
    public function create($id, array $contacts = [], string $name = '', string $uuid = null)
    {
        return $this->createOrJoin($id, [
            'contacts' => $contacts,
            'name' => $name,
            'uuid' => $uuid,
        ]);
    }

    /**
     * 机器人通过二维码加入某群
     *
     * @param string|int $id 机器人 id 或者 unionid
     * @param string $qrcode 二维码链接或二维码内容
     * @param string|int $roomId 群 id 或者 roomid，如传递则校验
     *
     * @return array|object|\Psr\Http\Message\ResponseInterface|string|\Weiliu\Open\Kernel\Support\Collection
     */
    public function joinByQrcode($id, string $qrcode, string $roomId = null)
    {
        return $this->createOrJoin($id, [
            'qrcode' => $qrcode,
            'room_id' => $roomId,
        ]);
    }

    /**
     * @param string|int $id 机器人 id 或者 unionid
     * @param string|int $roomId 群 id 或者 roomid
     * @param array $data
     *
     * @return array|object|\Psr\Http\Message\ResponseInterface|string|\Weiliu\Open\Kernel\Support\Collection
     */
    public function update($id, $roomId, array $data)
    {
        return $this->httpPut("robots/{$id}/rooms/{$roomId}", $data);
    }

    /**
     * 更新机器人的群内昵称
     *
     * @param string|int $id 机器人 id 或者 unionid
     * @param string|int $roomId 群 id 或者 roomid
     * @param string $nick 群内昵称
     *
     * @return array|object|\Psr\Http\Message\ResponseInterface|string|\Weiliu\Open\Kernel\Support\Collection
     */
    public function updateNick($id, $roomId, string $nick)
    {
        return $this->update($id, $roomId, [
            'nick' => $nick
        ]);
    }

    /**
     * 更新机器人的群消息通知状态
     *
     * @param $id
     * @param $roomId
     * @param string $status 暂只支持 off 状态
     *
     * @return array|object|\Psr\Http\Message\ResponseInterface|string|\Weiliu\Open\Kernel\Support\Collection
     */
    public function updateNotificationStatus($id, $roomId, $status)
    {
        return $this->update($id, $roomId, [
            'notification_status' => $status
        ]);
    }

    /**
     * 发送消息
     *
     * @param string|int $id 机器人 id 或者 unionid
     * @param string|int $roomId 群 id 或者 roomid
     * @param $message
     *
     * @return array|object|\Psr\Http\Message\ResponseInterface|string|\Weiliu\Open\Kernel\Support\Collection
     */
    public function sendMessage($id, $roomId, array $message)
    {
        return $this->httpPost("robots/{$id}/rooms/{$roomId}/messages", $message);
    }


    /**
     * 发送群内文字消息
     *
     * @param string|int $id 机器人 id 或者 unionid
     * @param string|int $roomId 群 id 或者 roomid
     * @param string $text
     * @param string|int $atRoomContact 需要 at 的群联系人 id 或者 unionid
     *
     * @return array|object|\Psr\Http\Message\ResponseInterface|string|\Weiliu\Open\Kernel\Support\Collection
     */
    public function sendTextMessage($id, $roomId, string $text, string $atRoomContact = null)
    {
        return $this->sendMessage($id, $roomId, [
            'type' => 'text',
            'text' => $text,
            'at_room_contact' => $atRoomContact,
        ]);
    }

    /**
     * 发送群内图片消息
     *
     * @param string|int $id 机器人 id 或者 unionid
     * @param string|int $roomId 群 id 或者 roomid
     * @param string $image
     *
     * @return array|object|\Psr\Http\Message\ResponseInterface|string|\Weiliu\Open\Kernel\Support\Collection
     */
    public function sendImageMessage($id, $roomId, string $image)
    {
        return $this->sendMessage($id, $roomId, [
            'type' => 'image',
            'image' => $image
        ]);
    }

    /**
     * 发送群内链接消息
     *
     * @param string|int $id 机器人 id 或者 unionid
     * @param string|int $roomId 群 id 或者 roomid
     * @param string $title
     * @param string $desc
     * @param string $image
     * @param string $link
     *
     * @return array|object|\Psr\Http\Message\ResponseInterface|string|\Weiliu\Open\Kernel\Support\Collection
     */
    public function sendLinkMessage($id, $roomId, string $title, string $desc, string $image, string $link)
    {
        return $this->sendMessage($id, $roomId, [
            'type' => 'link',
            'title' => $title,
            'desc' => $desc,
            'image' => $image,
            'link' => $link,
        ]);
    }

    /**
     * 发送群内视频消息
     *
     * @param string|int $id 机器人 id 或者 unionid
     * @param string|int $roomId 群 id 或者 roomid
     * @param string $videoUrl
     * @param string $videoWidth
     * @param string $videoHeight
     * @param $duration
     * @param string $imageUrl
     *
     * @return array|object|\Psr\Http\Message\ResponseInterface|string|\Weiliu\Open\Kernel\Support\Collection
     */
    public function sendVideoMessage($id, $roomId, string $videoUrl, string $videoWidth, string $videoHeight, $duration, string $imageUrl)
    {
        return $this->sendMessage($id, $roomId, [
            'type' => 'video',
            'video_url' => $videoUrl,
            'video_width' => $videoWidth,
            'video_height' => $videoHeight,
            'duration' => $duration,
            'image_url' => $imageUrl,
        ]);
    }

    /**
     * 退群
     *
     * @param string|int $id 机器人 id 或者 unionid
     * @param string|int $roomId 群 id 或者 roomid
     *
     * @return array|object|\Psr\Http\Message\ResponseInterface|string|\Weiliu\Open\Kernel\Support\Collection
     */
    public function delete($id, $roomId)
    {
        return $this->httpDelete("robots/{$id}/rooms/{$roomId}");
    }
}