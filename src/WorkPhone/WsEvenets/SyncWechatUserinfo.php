<?php

namespace Weiliu\Open\WorkPhone\WsEvenets;

/**
 * 同步当前登录用户数据
 */
class SyncWechatUserinfo extends WsEvent
{
    public function event()
    {
        return 'sync_wechat_storages';
    }

    public function data()
    {
        return [
            'context' => json_encode(['event' => 'userinfo:2'], JSON_UNESCAPED_UNICODE),
            'results' => [
                <<<SQL
select * from "userinfo" where "userinfo"."id" in ('2', '4', '6', '42', '12291', '12292', '12293')
SQL,
                <<<SQL1
select * from "userinfo2" where "userinfo2"."sid" in ('USERINFO_SELFINFO_SMALLIMGURL_STRING')
SQL1
            ],
        ];
    }
}