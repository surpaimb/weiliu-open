<?php

namespace Weiliu\Open\Support\Facades;

use Illuminate\Support\Facades\Facade;
use Weiliu\Open\Support\Application;

/**
 * @method static \Weiliu\Open\Support\Auth\Signer signer() signer
 * @method static \Weiliu\Open\Support\Charge\Charge charge() 支付凭据
 * @method static \Weiliu\Open\Support\File\File file() 文件
 *
 * @mixin Application
 */
class Support extends Facade
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