<?php

namespace Weiliu\Open\Kernel;

use Weiliu\Open\Kernel\Providers\ConfigServiceProvider;
use Weiliu\Open\Kernel\Providers\EventDispatcherServiceProvider;
use Weiliu\Open\Kernel\Providers\HttpClientServiceProvider;
use Weiliu\Open\Kernel\Providers\LogServiceProvider;
use Weiliu\Open\Kernel\Providers\RequestServiceProvider;
use Weiliu\Open\Kernel\Providers\SignerServiceProvider;
use Pimple\Container;

/**
 * Class ServiceContainer.
 *
 * @property \Weiliu\Open\Kernel\Config $config
 * @property \Symfony\Component\HttpFoundation\Request $request
 * @property \GuzzleHttp\Client $http_client
 * @property \Monolog\Logger $logger
 * @property \Symfony\Component\EventDispatcher\EventDispatcher $events
 * @property \Weiliu\Open\Kernel\Signer $signer
 */
class ServiceContainer extends Container
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var array
     */
    protected $providers = [];

    /**
     * @var array
     */
    protected $defaultConfig = [];

    /**
     * @var array
     */
    protected $userConfig = [];

    /**
     * Constructor.
     *
     * @param array $config
     * @param array $prepends
     * @param string|null $id
     */
    public function __construct(array $config = [], array $prepends = [], string $id = null)
    {
        $this->id = $id;
        $this->userConfig = $config;
        parent::__construct($prepends);
        $this->registerProviders($this->getProviders());
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id ?? $this->id = md5(json_encode($this->userConfig));
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        $base = [
            // http://docs.guzzlephp.org/en/stable/request-options.html
            'http' => [
                'timeout' => 30.0,
            ],
        ];

        return array_replace_recursive($base, $this->defaultConfig, $this->userConfig);
    }

    /**
     * Return all providers.
     *
     * @return array
     */
    public function getProviders()
    {
        return array_merge([
            ConfigServiceProvider::class,
            LogServiceProvider::class,
            RequestServiceProvider::class,
            HttpClientServiceProvider::class,
            EventDispatcherServiceProvider::class,
            SignerServiceProvider::class,
        ], $this->providers);
    }

    /**
     * @param string $id
     * @param mixed $value
     */
    public function rebind($id, $value)
    {
        $this->offsetUnset($id);
        $this->offsetSet($id, $value);
    }

    /**
     * Magic get access.
     *
     * @param string $id
     *
     * @return mixed
     */
    public function __get($id)
    {
        return $this->offsetGet($id);
    }

    /**
     * Magic set access.
     *
     * @param string $id
     * @param mixed $value
     */
    public function __set($id, $value)
    {
        $this->offsetSet($id, $value);
    }

    /**
     * @param array $providers
     */
    public function registerProviders(array $providers)
    {
        foreach ($providers as $provider) {
            parent::register(new $provider());
        }
    }
}