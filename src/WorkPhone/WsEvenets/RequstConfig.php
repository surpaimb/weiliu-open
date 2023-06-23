<?php

namespace Weiliu\Open\WorkPhone\WsEvenets;

/**
 * 换绑后重新请求 /sensitive_settings
 */
class RequstConfig extends WsEvent
{
    public function event()
    {
        return 'requst_config';
    }
}
