<?php

namespace Weiliu\Open\WorkPhone\WsEvenets;

/**
 * 同步微信表情
 */
class SyncWechatEmojis extends WsEvent
{
    protected $md5s;

    public function __construct($md5s)
    {
        $this->md5s = $md5s;
    }

    public function event()
    {
        return 'sync_wechat_storages';
    }

    public function data()
    {
        $in = join(
            ', ',
            array_map(function ($md5) {
                return "'{$md5}'";
            }, $this->md5s)
        );

        return [
            'context' => json_encode(['event' => 'emoji'], JSON_UNESCAPED_UNICODE),
            'results' => [
                <<<SQL
select * from "emojiInfo" where "emojiInfo"."md5" in ({$in})
SQL
            ],
        ];
    }
}