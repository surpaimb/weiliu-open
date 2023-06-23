<?php

namespace Weiliu\Open\UrlShortener;

use Weiliu\Open\Kernel\ServiceContainer;

/**
 * Class Application.
 *
 * @property \Weiliu\Open\UrlShortener\App\AppClient $app 应用
 * @property \Weiliu\Open\UrlShortener\ShortUrl\ShortUrlClient shortUrl 短链接
 */
class Application extends ServiceContainer
{
    const PRODUCTION_ENV = 'production';
    const DEVELOP_ENV = 'develop';

    /**
     * @var array
     */
    protected $providers = [
        Auth\ServiceProvider::class,
        App\ServiceProvider::class,
        ShortUrl\ServiceProvider::class,
    ];

    /**
     * @var array
     */
    protected $defaultConfig = [
        'http' => [
            'timeout' => 10.0,
            'base_uri' => 'https://xbs2023.cn'
        ],
    ];

    public function __construct(
        string $appid,
        string $appsecret,
        ?string $publicKey = null,
        ?string $env = self::PRODUCTION_ENV,
        array $config = [],
        array $prepends = [],
        string $id = null
    )
    {
        parent::__construct(
            array_merge([
                'appid' => $appid,
                'appsecret' => $appsecret,
                'publickey' => $publicKey,
                'env' => $env,
            ], $config),
            $prepends,
            $id
        );
    }

    public function getConfig()
    {
        $config = parent::getConfig();

        switch ($config['env'] ?? self::PRODUCTION_ENV) {
            case self::PRODUCTION_ENV:
                $config['http']['base_uri'] = 'https://xbs2023.cn';
                break;
            case self::DEVELOP_ENV:
            default:
                $config['http']['base_uri'] = 'http://dev.xbs2023.cn';
                break;
        }

        return $config;
    }
}