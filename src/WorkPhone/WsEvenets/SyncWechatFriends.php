<?php

namespace Weiliu\Open\WorkPhone\WsEvenets;

/**
 * 同步微信好友
 */
class SyncWechatFriends extends WsEvent
{
    public function event()
    {
        return 'sync_wechat_storages';
    }

    public function data()
    {
        return [
            'context' => json_encode(['event' => 'rcontact'], JSON_UNESCAPED_UNICODE),
            'results' => [
                <<<SQL
select "rcontact"."username", "rcontact"."type", "rcontact"."alias", "rcontact"."nickname" as "nick", "img_flag"."reserved2" as "avatar" from "rcontact" left join "img_flag" on "rcontact"."username" = "img_flag"."username" where "type" in ('1', '2', '3', '4', '7', '259', '2049', '2051', '8193', '65536', '65537', '65539')
SQL
            ],
        ];
    }
}