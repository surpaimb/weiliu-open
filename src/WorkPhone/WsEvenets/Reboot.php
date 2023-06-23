<?php

namespace Weiliu\Open\WorkPhone\WsEvenets;

/**
 * 重启手机
 */
class Reboot extends WsEvent
{
    public function event()
    {
        return 'reboot_mobile';
    }
}
