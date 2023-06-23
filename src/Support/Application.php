<?php

namespace Weiliu\Open\Support;

use SDK\Kernel\ServiceContainer;

/**
 * Class Application.
 *
 * @property \Weiliu\Open\Support\Auth\Signer $signer signer
 * @property \Weiliu\Open\Support\Charge\Charge $charge 支付凭据
 * @property \Weiliu\Open\Support\File\File $file 文件
 */
class Application extends ServiceContainer
{
    /**
     * @var array
     */
    protected $providers = [
        Auth\ServiceProvider::class,
        Charge\ServiceProvider::class,
        File\ServiceProvider::class,
    ];

    /**
     * @var array
     */
    protected $defaultConfig = [
        'http' => [
            'base_uri' => 'http://v.wl2018888.cn',
        ],
        'token' => 'weiliusupport',
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
                $config['http']['base_uri'] = 'http://v.wl2018888.cn';
                break;
            default:
                $config['http']['base_uri'] = 'http://v-dev.wl2018888.cn';
                break;
        }

        return $config;
    }
}