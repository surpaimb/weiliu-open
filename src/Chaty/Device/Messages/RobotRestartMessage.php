<?php

namespace Weiliu\Open\Chaty\Device\Messages;

/**
 * Class RobotRestartMessage
 *
 * @package Weiliu\Open\Chaty\Device\Messages
 */
class RobotRestartMessage extends Message
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setEvent('robot');
        $this->setType('restart');
        $this->setOs('ipados');
        $data = [
            'hash' => $this->get('hash', $this->get('unique', $this->get('token'))),
            'unique' => $this->get('unique', $this->get('token')),
        ];
        if ($this->has('tag')) {
            $data['tag'] = $this->get('tag');
        }
        if ($this->has('wxid')) {
            $data['agent_wxId'] = $this->get('wxid');
        }
        $deviceinfo = $this->get('deviceinfo');
        if (is_string($deviceinfo)) {
            $deviceinfo = json_decode($deviceinfo, 1);
        }
        $data = array_merge((array)$deviceinfo, $data);
        $this->setData($data);
        $this->attributes = [];
    }
}