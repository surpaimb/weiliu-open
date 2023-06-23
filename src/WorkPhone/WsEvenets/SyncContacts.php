<?php

namespace Weiliu\Open\WorkPhone\WsEvenets;

/**
 * 全量同步通讯录
 */
class SyncContacts extends WsEvent
{
    public function event()
    {
        return 'sync_contacts';
    }
}