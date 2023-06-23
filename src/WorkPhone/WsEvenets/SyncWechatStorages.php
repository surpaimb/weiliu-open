<?php

namespace Weiliu\Open\WorkPhone\WsEvenets;

/**
 * 同步微信存储数据
 */
class SyncWechatStorages extends WsEvent
{
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function event()
    {
        return 'sync_wechat_storages';
    }

    public function data()
    {
        return $this->data;
    }
}