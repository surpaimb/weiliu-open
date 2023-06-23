<?php

namespace Weiliu\Open\WorkPhone\WsEvenets;

/**
 * 同步微信群数据
 */
class SyncWechatChatrooms extends WsEvent
{
    public function event()
    {
        return 'sync_wechat_storages';
    }

    public function data()
    {
        return [
            'context' => json_encode(['event' => 'chatroom'], JSON_UNESCAPED_UNICODE),
            'results' => [
                <<<SQL
select "chatroom"."chatroomname", "chatroom"."displayname", "chatroom"."memberlist", "chatroom"."roomowner", "chatroom"."memberCount", "img_flag"."reserved2" as "cover", "rcontact"."nickname" as "nick" from "chatroom" left join "rcontact" on "chatroom"."chatroomname" = "rcontact"."username" left join "img_flag" on "chatroom"."chatroomname" = "img_flag"."username"
SQL
            ],
        ];
    }
}