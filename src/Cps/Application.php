<?php

namespace Weiliu\Open\Cps;

use Weiliu\Open\Kernel\ServiceContainer;

/**
 * Class Application.
 *
 * @property \Weiliu\Open\Cps\Shop\ShopClient $shop 店铺
 * @property \Weiliu\Open\Cps\Product\ProductClient $product 商品
 * @property \Weiliu\Open\Cps\Coupon\CouponClient $coupon 优惠券
 * @property \Weiliu\Open\Cps\Category\CategoryClient $category 分类
 * @property \Weiliu\Open\Cps\Taobaoke\TaobaokeClient $taobaoke 淘宝客
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
        Shop\ServiceProvider::class,
        Product\ServiceProvider::class,
        Coupon\ServiceProvider::class,
        Category\ServiceProvider::class,
        Taobaoke\ServiceProvider::class,
    ];

    /**
     * @var array
     */
    protected $defaultConfig = [
        'http' => [
            'timeout' => 10.0,
            'base_uri' => 'http://cps.v5h6.com'
        ],
    ];

    public function __construct(string $token = null, array $config = [], array $prepends = [], string $id = null)
    {
        $config['token'] = $token ?: 'weiliucps';
        parent::__construct($config, $prepends, $id);
    }

    public function getConfig()
    {
        $config = parent::getConfig();

        switch ($config['env'] ?? self::PRODUCTION_ENV) {
            case self::PRODUCTION_ENV:
                $config['http']['base_uri'] = 'http://cps.v5h6.com';
                break;
            case self::DEVELOP_ENV:
            default:
                $config['http']['base_uri'] = 'http://dev-cps.v5h6.com';
                break;
        }

        return $config;
    }
}