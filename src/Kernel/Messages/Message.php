<?php

namespace Weiliu\Open\Kernel\Messages;

use Weiliu\Open\Kernel\Contracts\MessageInterface;
use Weiliu\Open\Kernel\Support\Str;
use Weiliu\Open\Kernel\Traits\HasAttributes;

/**
 * Class Messages.
 */
abstract class Message implements MessageInterface
{
    use HasAttributes;

    // ping
    const PING_ROBOT = 2;
    const PING = self::PING_ROBOT;

    // group
    const GROUP_TEXT = 4; // 文字群消息
    const GROUP_NEW_MEMBER = 8; // 新入群
    const GROUP_INFO = 16; // 群消息同步
    const GROUP_AATE = 32; // 在群里@群主协议
    const GROUP_CREATE_CHATROOM_STATUS = 64; // 新建群聊回调
    const GROUP_SEND_MINI_PROGRAM = 128; // 群内有人发送小程序的事件类型
    const GROUP = self::GROUP_TEXT | self::GROUP_NEW_MEMBER | self::GROUP_INFO
    | self::GROUP_AATE | self::GROUP_CREATE_CHATROOM_STATUS | self::GROUP_SEND_MINI_PROGRAM;

    // passfriend
    const PASSFRIEND_TEXT = 256; // 通过加好友请求类型
    const PASSFRIEND = self::PASSFRIEND_TEXT;

    // message
    const MESSAGE_TEXT = 1024; // 文本消息
    const MESSAGE_SYSTEM = 2048; // 系统消息
    const MESSAGE_IMAGE = 4096; // 图片消息
    const MESSAGE_VOICE = 8192; // 语音消息
    const MESSAGE_LINK = 16384; // 图文连接
    const MESSAGE_EMOJI = 32786; // 表情
    const MESSAGE_CARD = 65536; // 名片
    const MESSAGE_VIDEO = 131072; // 视频
    const MESSAGE_SEND_MINI_PROGRAM = 262144; // 小程序
    const MESSAGE_SEND_VIDEO_RESPONSE = 524288; // 发送视频回调
    const MESSAGE = self::MESSAGE_TEXT | self::MESSAGE_SYSTEM | self::MESSAGE_IMAGE | self::MESSAGE_VOICE
    | self::MESSAGE_LINK | self::MESSAGE_EMOJI | self::MESSAGE_CARD | self::MESSAGE_VIDEO | self::MESSAGE_SEND_MINI_PROGRAM
    | self::MESSAGE_SEND_VIDEO_RESPONSE;

    const ROBOT_INVITE_FROM = 1048576; // 邀请关系绑定
    const ROBOT_QRCODE = 2087152; // 上报机器人二维码
    const ROBOT_FAULT = 4194304; // 故障上报
    const ROBOT_START_COMPLETE = 8388608; // 机器人沙盒准备好

    const FRIEND_SYNC = 16777216; // 同步好友信息

    const TIMELINE_COMMENT = 33554432; // 朋友圈评论
    const TIMELINE_PUBLISH = 67108864; // 发布朋友圈
    const TIMELINE_VIEW = 134217728; // 朋友圈发布成功回调type

    const HONGBAO_SEND = 268435456; // 发送回调
    const HONGBAO_REPOR_TINFO = 536870912; // 红包详细信息上报

    const PAYMENT_QRCODE = 1073741824; // 生成付款二维码 - 回调
    const PAYMENT_SYNC = 2147483648; // 付款成功 - 回调

    const UPLOAD_MSG_IMAGE_QRCODE = 4294967296; // 上传图片中的二维码内容

    const VIDEO_SEND_VIDEO_RESPONSE = 8589934592; // 发送视频回调

    const ALL = self::PING | self::GROUP;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $event;

    /**
     * @var string
     */
    protected $os;

    /**
     * @var array
     */
    protected $data;

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $to;

    /**
     * @var string
     */
    protected $from;

    /**
     * @var array
     */
    protected $properties = [];

    /**
     * @var array
     */
    protected $jsonAliases = [];

    /**
     * Message constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->setAttributes($attributes);
        $this->id = Str::uuid()->toString();
    }

    public function getId(): string
    {
        return (string)$this->id;
    }

    /**
     * @return string
     */
    public function getEvent(): string
    {
        return (string)$this->event;
    }

    /**
     * @param string $event
     */
    public function setEvent(string $event)
    {
        $this->event = $event;
    }

    /**
     * Return type name message.
     *
     * @return string
     */
    public function getType(): string
    {
        return (string)$this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type)
    {
        $this->type = $type;
    }

    /**
     * @return null|string
     */
    public function getOs(): ? string
    {
        return (string)$this->os;
    }

    /**
     * @param string $os
     */
    public function setOs(string $os)
    {
        $this->os = $os;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return (array)$this->data;
    }

    /**
     * @param array $data
     */
    public function setData(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function transformForJsonRequest(): array
    {
        $data = [
            'event' => $this->getEvent(),
            'type' => $this->getType(),
            'data' => json_encode($this->getData(), JSON_UNESCAPED_UNICODE),
        ];

        if ($id = $this->getId()) {
            $data['id'] = $id;
        }

        return $data;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return array_merge($this->attributes, $this->transformForJsonRequest());
    }

    /**
     * Magic getter.
     *
     * @param string $property
     *
     * @return mixed
     */
    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }

        return $this->getAttribute($property);
    }

    /**
     * Magic setter.
     *
     * @param string $property
     * @param mixed $value
     *
     * @return Message
     */
    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        } else {
            $this->setAttribute($property, $value);
        }

        return $this;
    }
}