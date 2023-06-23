<?php

namespace Weiliu\Open\WorkPhone;

use SDK\Kernel\ServiceContainer;

/**
 * Class Application.
 *
 * @property \Weiliu\Open\WorkPhone\Auth\Signer $signer signer
 * @property \Weiliu\Open\WorkPhone\Ws\Ws $ws websocket
 * @property \Weiliu\Open\WorkPhone\Device\Device $device 设备相关
 * @property \Weiliu\Open\WorkPhone\Chatroom\Chatroom $chatroom 客户群相关
 */
class Application extends ServiceContainer
{
    /**
     * @var array
     */
    protected $providers = [
        Auth\ServiceProvider::class,
        Ws\ServiceProvider::class,
        Device\ServiceProvider::class,
        Chatroom\ServiceProvider::class,
    ];

    /**
     * @var array
     */
    protected $defaultConfig = [
        'http' => [
            'base_uri' => 'http://center-api.jukexiao.com',
        ],
    ];

    public function __construct(array $config = [], array $prepends = [])
    {
        parent::__construct($config, $prepends);
    }

    public function getConfig()
    {
        $config = parent::getConfig();

        switch ($config['env'] ?? 'production') {
            case 'production':
                $config['http']['base_uri'] = 'http://center-api.jukexiao.com';
                break;
            default:
                $config['http']['base_uri'] = 'http://crm-center-api-dev.qinbaowan.cn';
                break;
        }

        return $config;
    }
}