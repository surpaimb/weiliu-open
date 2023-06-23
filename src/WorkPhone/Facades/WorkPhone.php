<?php

namespace Weiliu\Open\WorkPhone\Facades;

use Illuminate\Support\Facades\Facade;
use Weiliu\Open\WorkPhone\Application;

/**
 * @method static \Weiliu\Open\WorkPhone\Auth\Signer signer() signer
 * @method static \Weiliu\Open\WorkPhone\Ws\Ws ws() websocket
 * @method static \Weiliu\Open\WorkPhone\Device\Device device() 设备相关
 * @method static \Weiliu\Open\WorkPhone\Chatroom\Chatroom chatroom() 客户群相关
 *
 * @mixin Application
 */
class WorkPhone extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Application::class;
    }

    /**
     * @return Application
     */
    public static function getFacadeRoot()
    {
        return parent::getFacadeRoot();
    }

    /**
     * @param string $method
     * @param array $args
     *
     * @return mixed
     */
    public static function __callStatic($method, $args)
    {
        $instance = static::getFacadeRoot();

        if (!$instance) {
            throw new \RuntimeException('A facade root has not been set.');
        }

        if ($instance->offsetExists($method)) {
            return $instance->offsetGet($method);
        }

        return $instance->$method(...$args);
    }
}