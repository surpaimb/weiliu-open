# weiliu-open.chaty

## 使用

```php
<?php

use Weiliu\Open\Factory;
use Weiliu\Open\Chaty\Application as Chaty;

$chaty = Factory::chaty('appid', 'appsecret', Chaty::PRODUCTION_ENV);
```

### 作为服务端的接收例子

```php
<?php

$server = $chaty->server;

// \UserHandlers\LogHandler 需要 implements 并实现 \Weiliu\Open\Kernel\Contracts\EventHandlerInterface
// 注册所有 event 和 type 的处理器
$server->push(\UserHandlers\LogHandler::class);
// 注册 event = qrcode 和 type = auth 的处理器
// 一个 qrcode.auth 的请求会先走 LogHandler 再到 QrcodeAuthHandler，可以重复追加处理器，同理按注册顺序依次执行.
// 如果某个处理器 handle 方法中有 return 值则中断
$server->push(\UserHandlers\QrcodeAuthHandler::class, 'qrcode.auth');

// 返回的是 Response 对象
$server->serve();
```

### 作为客户端的请求例子

```php
<?php

// handle_client_exception == true
// 请求设备列表
$list = $chaty->device->list();
// 存在 code 和 message 则是异常响应
if (isset($list['code']) && isset($list['message'])) {
    var_dump($error = $list);
} else {
    var_dump($list);
}

// handle_client_exception == false
try {
    // 请求设备列表
    var_dump($chaty->device->list());
} catch (ClientException $exception) {
    // 自己处理异常获取，响应值
    var_dump($exception->getResponse()->getBody()->getContents());
}
```

## 名词解释

- unionid 

如微信机器人则等同于其 wxid

- device 设备

安卓等同于手机设备/ipad等同于windows服务器

- 外部id

指代第三方id，部分同 unionid

## 相关文档

- [客户端API](http://gitlab.v6h5.cn/php/weiliu-open/tree/master/src/Chaty/CLIENT.md)
- [服务端上报事件](http://gitlab.v6h5.cn/php/weiliu-open/tree/master/src/Chaty/SERVER.md)