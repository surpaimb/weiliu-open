<?php

namespace Weiliu\Open\Chaty;

use Weiliu\Open\Kernel\ServiceContainer;

/**
 * Class Application.
 *
 * @property \Weiliu\Open\Chaty\Server\Guard $server
 * @property \Weiliu\Open\Chaty\Auth\AccessToken $access_token
 * @property \Weiliu\Open\Chaty\App\AppClient $app 应用
 * @property \Weiliu\Open\Chaty\Device\DeviceClient $device 设备
 * @property \Weiliu\Open\Chaty\Profile\ProfileClient $profile 第三方用户(user profile)
 * @property \Weiliu\Open\Chaty\Robot\Robot $robot 机器人
 * @property \Weiliu\Open\Chaty\Contact\ContactClient $contact 联系人
 * @property \Weiliu\Open\Chaty\Room\RoomClient $room 群
 * @property \Weiliu\Open\Chaty\RoomContact\RoomContactClient $roomContact 群联系人
 */
class Application extends ServiceContainer
{
    const PRODUCTION_ENV = 'production';
    const DEVELOP_ENV = 'develop';

    /**
     * @var array
     */
    protected $providers = [
        Server\ServiceProvider::class,
        Auth\ServiceProvider::class,
        App\ServiceProvider::class,
        Profile\ServiceProvider::class,
        Device\ServiceProvider::class,
        Robot\ServiceProvider::class,
        Contact\ServiceProvider::class,
        Room\ServiceProvider::class,
        RoomContact\ServiceProvider::class,
    ];

    protected $defaultConfig = [
        'http' => [
            'timeout' => 5.0,
            'base_uri' => 'https://weiliuchaty-api.v6h5.com'
        ],
    ];

    public function __construct(
        string $appid, string $appsecret, ?string $env = self::PRODUCTION_ENV,
        array $config = [], array $prepends = [], string $id = null
    )
    {
        $config = array_merge($config, [
            'appid' => $appid,
            'appsecret' => $appsecret,
            'env' => $env,
        ]);
        parent::__construct($config, $prepends, $id);
    }

    public function getConfig()
    {
        $config = parent::getConfig();

        switch ($config['env'] ?? self::PRODUCTION_ENV) {
            case self::PRODUCTION_ENV:
                $config['http']['base_uri'] = 'https://weiliuchaty-api.v6h5.com';
                break;
            case self::DEVELOP_ENV:
            default:
                $config['http']['base_uri'] = 'http://qun-api-test.xbs2023.cn';
                break;
        }

        return $config;
    }
}