<?php

namespace Weiliu\Open\DingTalk;

use Weiliu\Open\Kernel\ServiceContainer;

/**
 * Class Application.
 *
 * @property \Weiliu\Open\DingTalk\Robot\RobotClient $robot 钉钉机器人
 */
class Application extends ServiceContainer
{
    /**
     * @var array
     */
    protected $providers = [
        Robot\ServiceProvider::class,
    ];

    /**
     * @var array
     */
    protected $defaultConfig = [
        'http' => [
            'timeout' => 5.0,
            'base_uri' => 'https://oapi.dingtalk.com'
        ],
    ];
}