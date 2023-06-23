# weiliu-open 

SDK一个就好，集成CPS商品库/聊天机器人/短链/钉钉/淘宝客/大淘客/选单网/折淘客/好单库。

主要是好维护。

## 安装

composer.json

```json
{
  "repositories": [
    {
      "type": "composer",
      "url": "http://pkg.qinbaowan.cn"
    }
  ],
  "config": {
    "secure-http": false
  }
}
```

执行

```bash
composer require surpaimb/open
```

## 相关SDK 

私有服务SDK

- [chaty 聊天机器人服务(暂微信)SDK-文档](http://gitlab.v6h5.cn/php/weiliu-open/tree/master/src/Chaty/README.md)
- cps CPS服务(暂淘宝客)SDK
- urlShortener 短链接(活链)服务SDK

公网服务
- [dingTalk 钉钉SDK-文档](http://gitlab.v6h5.cn/php/weiliu-open/tree/master/src/DingTalk/README.md)

## 使用

```php
<?php

use Weiliu\Open\Factory;
use Weiliu\Open\Chaty\Application as Chaty;
use Weiliu\Open\UrlShortener\Application as UrlShortener;

// 公共配置(可选)
$config = [
    'log' => [
        'default' => 'daily',
        'channels' => [
            'daily' => [
                'driver' => 'daily',
                'path' => '/data/logs/open.log',
                'level' => 'debug',
                'days' => 14,
            ],
        ], 
    ],
];

# 自有服务
// 聊天机器人
Factory::chaty(env('CHATY_APPID'), env('CHATY_APPSECRET'), Chaty::PRODUCTION_ENV, $config);
// CPS 商品库
Factory::cps();
// 短链
Factory::urlShortener(env('URL_SHORTENER_APPID'), env('URL_SHORTENER_APPSECRET'), null, UrlShortener::PRODUCTION_ENV, $config);

# 其他服务
// 钉钉
Factory::dingTalk($config);
```

## 复杂的公共配置

```php

$config = [
    'log' => [
        'default' => 'slack',
        'channels' => [
            // 例如这个给作为服务端时的日志
            // driver => slack 可以合并多渠道
            'slack' => [
                'driver' => 'stack',
                'channels' => ['log', 'errorLog'],
            ],
            'log' => [
                'driver' => 'daily',
                // 绝对路径
                'path' => '/data/logs/test_chaty_server.log',
                'level' => 'debug',
                'days' => 14
            ],
            'errorLog' => [
                'driver' => 'daily',
                // 绝对路径
                'path' => '/data/logs/test_chaty_server_error.log',
                'level' => 'error',
                'days' => 14
            ],

            // 例如这个给作为客户端时的日志
            'clientLog' => [
                'driver' => 'daily',
                // 绝对路径
                'path' => '/data/logs/test_chaty_client.log',
                'level' => 'debug',
                'days' => 14
            ],
        ]
    ],
];
```