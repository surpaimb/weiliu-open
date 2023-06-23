<?php

namespace Weiliu\Open;

use Weiliu\Open\Chaty\Application as Chaty;
use Weiliu\Open\UrlShortener\Application as UrlShortener;
use Weiliu\Open\Cps\Application as Cps;
use Weiliu\Open\Support\Application as Support;
use Weiliu\Open\WorkPhone\Application as WorkPhone;
use Weiliu\Open\DingTalk\Application as DingTalk;

/**
 * Class Factory.
 *
 * 自有服务
 *
 * @method static Chaty chaty(string $appid, string $appsecret, ?string $env = Chaty::PRODUCTION_ENV, array $config = []) 聊天机器人
 * @method static UrlShortener urlShortener(string $appid, string $appsecret, ?string $publicKey = null, ?string $env = UrlShortener::PRODUCTION_ENV, array $config = []) 短链接
 * @method static Cps cps(string $token = null, array $config = []) Cps
 * @method static Support support(array $config = []) 基础服务
 * @method static WorkPhone workPhone(array $config = []) 工作手机
 *
 * 其他服务
 *
 * @method static DingTalk dingTalk(array $config = []) 钉钉
 */
class Factory
{
    /**
     * @param $name
     * @param array ...$arguments
     *
     * @return \Weiliu\Open\Kernel\ServiceContainer
     */
    public static function make($name, ...$arguments)
    {
        $namespace = Kernel\Support\Str::studly($name);
        $application = "\\Weiliu\\Open\\{$namespace}\\Application";

        return new $application(...$arguments);
    }

    /**
     * Dynamically pass methods to the application.
     *
     * @param string $name
     * @param array $arguments
     *
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        return self::make($name, ...$arguments);
    }
}