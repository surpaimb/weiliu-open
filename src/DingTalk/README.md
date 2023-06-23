# weiliu-open.dingTalk

钉钉开放平台相关，顺手加的

```php
$dingTalk = Factory::dingTalk([
    'webhook' => [
        'default' => 'online',
        'channels' => [
            'test' => 'webhook.access_token',
            'online' => 'webhook.access_token',
            'dev' => 'webhook.access_token',
        ]
    ]
]);
        
// 通知到线上群
$dingTalk->robot->sendText('asdasd');

// 通知到测试群
$dingTalk->robot->channel('test')->sendText('asdasd');
```

## API

### 机器人

- 发送消息 - dingTalk.robot.send
- 发送文字消息 - dingTalk.robot.sendText
- 发送链接消息 - dingTalk.robot.sendLink
- 发送markdown消息 - dingTalk.robot.sendMarkdown
- 发送actionCard消息 - dingTalk.robot.sendActionCard