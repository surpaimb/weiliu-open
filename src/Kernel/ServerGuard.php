<?php

namespace Weiliu\Open\Kernel;

use Weiliu\Open\Kernel\Contracts\MessageInterface;
use Weiliu\Open\Kernel\Exceptions\BadRequestException;
use Weiliu\Open\Kernel\Exceptions\InvalidArgumentException;
use Weiliu\Open\Kernel\Messages\Message;
use Weiliu\Open\Kernel\Traits\Observable;
use Weiliu\Open\Kernel\Traits\ResponseCastable;
use Symfony\Component\HttpFoundation\Response;

class ServerGuard
{
    use Observable;
    use ResponseCastable;

    /**
     * Empty string.
     */
    const SUCCESS_EMPTY_RESPONSE = 'success';

    /**
     * @var array
     */
    const MESSAGE_TYPE_MAPPING = [
        'ping' => [
            'robot' => Message::PING_ROBOT,
        ],

        'group' => [
            'text' => Message::GROUP_TEXT, // 文字群消息
            'new_member' => Message::GROUP_NEW_MEMBER, // 新入群
            'info' => Message::GROUP_INFO, // 群消息同步
            'aate' => Message::GROUP_AATE, // 在群里@群主协议
            'create_chatroom_status' => Message::GROUP_CREATE_CHATROOM_STATUS, // 新建群聊回调
            'SendMiniProgram' => Message::GROUP_SEND_MINI_PROGRAM, // 群内有人发送小程序的事件类型
        ],

        'passfriend' => [
            'text' => Message::PASSFRIEND_TEXT, // 通过加好友请求类型
        ],

        'message' => [
            'text' => Message::MESSAGE_TEXT, // 文本消息
            'system' => Message::MESSAGE_SYSTEM, // 系统消息
            'image' => Message::MESSAGE_IMAGE, // 图片消息
            'voice' => Message::MESSAGE_VOICE, // 语音消息
            'link' => Message::MESSAGE_LINK, // 图文连接
            'emoji' => Message::MESSAGE_EMOJI, // 表情
            'card' => Message::MESSAGE_CARD, // 名片
            'video' => Message::MESSAGE_VIDEO, // 视频
            'SendMiniProgram' => Message::MESSAGE_SEND_MINI_PROGRAM, // 小程序
            'send_video_response' => Message::MESSAGE_SEND_VIDEO_RESPONSE,
        ],

        'robot' => [
            'invite_from' => Message::ROBOT_INVITE_FROM, // 邀请关系绑定
            'qrcode' => Message::ROBOT_QRCODE, // 上报机器人二维码
            'fault' => Message::ROBOT_FAULT, // 故障上报
            'start_complete' => Message::ROBOT_START_COMPLETE, // 机器人沙盒准备好
        ],

        'friend' => [
            'sync' => Message::FRIEND_SYNC, // 同步好友信息
        ],

        'timeline' => [
            'comment' => Message::TIMELINE_COMMENT, // 朋友圈评论
            'publish' => Message::TIMELINE_PUBLISH, // 发布朋友圈
            'view' => Message::TIMELINE_VIEW, // 朋友圈发布成功回调type
        ],

        'hongbao' => [
            'send' => Message::HONGBAO_SEND, // 发送回调
            'reportInfo' => Message::HONGBAO_REPOR_TINFO, // 红包详细信息上报
        ],

        'payment' => [
            'qrcode' => Message::PAYMENT_QRCODE, // 生成付款二维码 - 回调
            'sync' => Message::PAYMENT_SYNC, // 付款成功 - 回调
        ],

        'upload' => [
            'msg_image_qrcode' => Message::UPLOAD_MSG_IMAGE_QRCODE, // 上传图片中的二维码内容
        ],

        'video' => [
            'send_video_response' => Message::VIDEO_SEND_VIDEO_RESPONSE, // 发送视频回调
        ],
    ];

    /**
     * @var array
     */
    const IPAD_MESSAGE_TYPE_MAPPING = [
        'group' => [
            'info' => Message::GROUP_INFO, // 群消息同步，是多个批量的
        ],

        'passfriend' => [
            'text' => Message::PASSFRIEND_TEXT, // 通过加好友请求类型
        ],

        'message' => [
            'text' => Message::MESSAGE_TEXT, // 文本消息
            'system' => Message::MESSAGE_SYSTEM, // 系统消息
            'image' => Message::MESSAGE_IMAGE, // 图片消息
            'voice' => Message::MESSAGE_VOICE, // 语音消息
            'link' => Message::MESSAGE_LINK, // 图文连接
            'emoji' => Message::MESSAGE_EMOJI, // 表情
        ],

        'robot' => [
            'qrcode' => Message::ROBOT_QRCODE, // 上报机器人二维码
            'syncFriendListFinish' => '', // 初始化同步好友完成
            'initUnique' => '', // 二维码登录类型: 初始化Unique [PC请求]
            'auth' => '', // 二维码登录类型: 获取二维码授权 ［主控ws］
            'scanLogin' => '', // 二维码登录类型: 扫码登录中［主控ws］
            'cancelLogin' => '', // 二维码登录类型: 取消扫码登录［主控ws］
            'submitLogin' => '', // 二维码登录类型: 提交登录［主控ws］
            'getQrCodeError' => '',  // 二维码登录类型: 获取二维码错误［主控ws］
            'scanLoginError' => '', // 二维码登录类型: 扫码登录错误［主控ws］
            'loginSuccess' => '', //  二维码登录类型: 登录成功 ［微信客户端ws］
        ],

        'timeline' => [
            'data.publish' => '', // 发布朋友圈的回调事件上报成功
            'data.publish_fail' => '', // 发布朋友圈的回调事件上报失败
            'view' => Message::TIMELINE_VIEW, // 朋友圈发布成功回调type
        ]
    ];

    /**
     * @var \Weiliu\Open\Kernel\ServiceContainer
     */
    protected $app;

    /**
     * Constructor.
     *
     * @codeCoverageIgnore
     *
     * @param \Weiliu\Open\Kernel\ServiceContainer $app
     */
    public function __construct(ServiceContainer $app)
    {
        $this->app = $app;
    }

    /**
     * Handle and return response.
     *
     * @return Response
     *
     * @throws \Weiliu\Open\Kernel\Exceptions\BadRequestException
     * @throws \Weiliu\Open\Kernel\Exceptions\InvalidArgumentException
     * @throws \Weiliu\Open\Kernel\Exceptions\InvalidConfigException
     */
    public function serve(): Response
    {
        $this->app['logger']->debug('Request received:', [
            'method' => $this->app['request']->getMethod(),
            'uri' => $this->app['request']->getUri(),
            'content-type' => $this->app['request']->getContentType(),
            'content' => $this->app['request']->getContent(),
        ]);

        $response = $this->validate()->resolve();

        $this->app['logger']->debug('Server response created:', ['content' => $response->getContent()]);

        return $response;
    }

    /**
     * @return $this
     *
     * @throws \Weiliu\Open\Kernel\Exceptions\BadRequestException
     */
    public function validate()
    {
        return $this;
    }

    /**
     * Get request message.
     *
     * @return array|\Weiliu\Open\Kernel\Support\Collection|object|string
     *
     * @throws \Weiliu\Open\Kernel\Exceptions\BadRequestException
     * @throws \Weiliu\Open\Kernel\Exceptions\InvalidArgumentException
     * @throws \Weiliu\Open\Kernel\Exceptions\InvalidConfigException
     */
    public function getMessage()
    {
        $message = array_merge(
            $this->app['request']->query->all(),
            $this->app['request']->request->all(),
            $this->parseMessage($this->app['request']->getContent(false))
        );

        if (!is_array($message) || empty($message)) {
            throw new BadRequestException('No message received.');
        }

        return $this->detectAndCastResponseToType($message, $this->app->config->get('response_type'));
    }

    /**
     * Resolve server request and return the response.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Weiliu\Open\Kernel\Exceptions\BadRequestException
     * @throws \Weiliu\Open\Kernel\Exceptions\InvalidArgumentException
     * @throws \Weiliu\Open\Kernel\Exceptions\InvalidConfigException
     */
    protected function resolve(): Response
    {
        $result = $this->handleRequest();

        if ($this->shouldReturnRawResponse()) {
            $response = new Response($result['response']);
        } else {
            $response = new Response(
                $this->buildResponse($result['to'], $result['from'], $result['response']),
                200,
                ['Content-Type' => 'application/json']
            );
        }

        return $response;
    }

    /**
     * @param string $to
     * @param string $from
     * @param \Weiliu\Open\Kernel\Contracts\MessageInterface|string|int $message
     *
     * @return string
     *
     * @throws \Weiliu\Open\Kernel\Exceptions\InvalidArgumentException
     */
    public function buildResponse(string $to, string $from, $message)
    {
        if (empty($message) || self::SUCCESS_EMPTY_RESPONSE === $message) {
            return self::SUCCESS_EMPTY_RESPONSE;
        }

        if (is_array($message)) {
            return json_encode($message, JSON_UNESCAPED_UNICODE);
        }

        if (!($message instanceof Message)) {
            throw new InvalidArgumentException(sprintf('Invalid Messages type "%s".', gettype($message)));
        }

        return $this->buildReply($to, $from, $message);
    }

    /**
     * Handle request.
     *
     * @return array
     *
     * @throws \Weiliu\Open\Kernel\Exceptions\BadRequestException
     * @throws \Weiliu\Open\Kernel\Exceptions\InvalidArgumentException
     * @throws \Weiliu\Open\Kernel\Exceptions\InvalidConfigException
     */
    protected function handleRequest(): array
    {
        $castedMessage = $this->getMessage();

        $messageArray = $this->detectAndCastResponseToType($castedMessage, 'array');

        $event = $messageArray['event'] ?? null;
        $type = $messageArray['type'] ?? null;

        $response = $this->dispatch([$event, $type], $messageArray);

        return [
            'to' => $messageArray['to'] ?? '',
            'from' => $messageArray['from'] ?? '',
            'response' => $response,
        ];
    }

    /**
     * Build reply.
     *
     * @param string $to
     * @param string $from
     * @param \Weiliu\Open\Kernel\Contracts\MessageInterface $message
     *
     * @return string
     */
    protected function buildReply(string $to, string $from, MessageInterface $message): string
    {
        $prepends = $message->transformForJsonRequest();

        return json_encode($prepends, JSON_UNESCAPED_UNICODE);
    }

    /**
     * Parse message array from raw php input.
     *
     * @param string $content
     *
     * @return array
     *
     * @throws \Weiliu\Open\Kernel\Exceptions\BadRequestException
     */
    protected function parseMessage($content)
    {
        try {
            if (strpos($content, '{') === 0) {
                // Handle JSON format.
                $content = json_decode($content, true);
                if (!$content || JSON_ERROR_NONE !== json_last_error()) {
                    $content = [];
                }
            } else {
                $array = [];
                foreach (explode('&', $content) as $item) {
                    $arr = explode('=', $item);
                    $array[trim($arr[0] ?? '')] = trim($arr[1] ?? '');
                }
                $content = $array;
            }
            return $content;
        } catch (\Exception $e) {
            throw new BadRequestException(sprintf('Invalid message content:(%s) %s', $e->getCode(), $e->getMessage()), $e->getCode());
        }
    }

    /**
     * @return bool
     */
    protected function shouldReturnRawResponse(): bool
    {
        return false;
    }
}