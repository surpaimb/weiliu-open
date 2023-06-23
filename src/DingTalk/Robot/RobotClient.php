<?php

namespace Weiliu\Open\DingTalk\Robot;

use Weiliu\Open\Kernel\BaseClient;

/**
 * 钉钉机器人
 */
class RobotClient extends BaseClient
{
    /**
     * @var string
     */
    protected $channel;

    /**
     * @param string $channel
     *
     * @return $this
     */
    public function setChannel(string $channel)
    {
        $this->channel = $channel;

        return $this;
    }

    /**
     * @param string $channel
     *
     * @return $this
     */
    public function channel(string $channel)
    {
        return (clone $this)->setChannel($channel);
    }

    /**
     * 钉钉机器人发送消息
     *
     * @param array $data
     *
     * @return array|object|\Psr\Http\Message\ResponseInterface|string|\Weiliu\Open\Kernel\Support\Collection
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Weiliu\Open\Kernel\Exceptions\InvalidConfigException
     */
    public function send(array $data)
    {
        $channels = (array)$this->app->config->get('webhook.channels', []);
        $channel = $this->channel ?: $this->app->config->get('webhook.default', '');
        $accessToken = $channels[$channel] ?? '';

        return $this->httpPostJson('robot/send', $data, [
            'access_token' => (string)$accessToken
        ]);
    }

    /**
     * 钉钉机器人发送文字消息
     *
     * @param string $content
     * @param array $atMobiles
     * @param bool $isAtAll
     *
     * @return array|object|\Psr\Http\Message\ResponseInterface|string|\Weiliu\Open\Kernel\Support\Collection
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Weiliu\Open\Kernel\Exceptions\InvalidConfigException
     */
    public function sendText(string $content, array $atMobiles = [], bool $isAtAll = false)
    {
        $data = [
            'msgtype' => 'text',
            'text' => [
                'content' => $content
            ]
        ];

        if ($atMobiles || $isAtAll) {
            $data['at'] = [
                'atMobiles' => $atMobiles,
                'isAtAll' => $isAtAll
            ];
        }

        return $this->send($data);
    }

    /**
     * 钉钉机器人发送链接消息
     *
     * @param string $title
     * @param string $text
     * @param string $messageUrl
     * @param string $picUrl
     *
     * @return array|object|\Psr\Http\Message\ResponseInterface|string|\Weiliu\Open\Kernel\Support\Collection
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Weiliu\Open\Kernel\Exceptions\InvalidConfigException
     */
    public function sendLink(string $title, string $text, string $messageUrl, string $picUrl = '')
    {
        $data = [
            'msgtype' => 'link',
            'link' => [
                'text' => $text,
                'title' => $title,
                'picUrl' => $picUrl,
                'messageUrl' => $messageUrl
            ]
        ];

        return $this->send($data);
    }

    /**
     * 钉钉机器人发送 markdown 消息
     *
     * @param string $title
     * @param string $text
     * @param array $atMobiles
     * @param bool $isAtAll
     *
     * @return array|object|\Psr\Http\Message\ResponseInterface|string|\Weiliu\Open\Kernel\Support\Collection
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Weiliu\Open\Kernel\Exceptions\InvalidConfigException
     */
    public function sendMarkdown(string $title, string $text, array $atMobiles = [], bool $isAtAll = false)
    {
        $data = [
            'msgtype' => 'markdown',
            'markdown' => [
                'title' => $title,
                'text' => $text,
            ]
        ];

        if ($atMobiles || $isAtAll) {
            $data['at'] = [
                'atMobiles' => $atMobiles,
                'isAtAll' => $isAtAll
            ];
        }

        return $this->send($data);
    }

    /**
     * 钉钉机器人发送 actionCard 消息
     *
     * @param string $title
     * @param string $text
     * @param string $singleTitle
     * @param string $singleURL
     *
     * @return array|object|\Psr\Http\Message\ResponseInterface|string|\Weiliu\Open\Kernel\Support\Collection
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Weiliu\Open\Kernel\Exceptions\InvalidConfigException
     */
    public function sendActionCard(string $title, string $text, string $singleTitle, string $singleURL)
    {
        $data = [
            'msgtype' => 'actionCard',
            'actionCard' => [
                'title' => $title,
                'text' => $text,
                'singleTitle' => $singleTitle,
                'singleURL' => $singleURL
            ]
        ];

        return $this->send($data);
    }
}