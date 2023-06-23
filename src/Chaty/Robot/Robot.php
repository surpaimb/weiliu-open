<?php

namespace Weiliu\Open\Chaty\Robot;

use Weiliu\Open\Kernel\Exceptions\InvalidArgumentException;

/**
 * 机器人
 *
 * @property \Weiliu\Open\Chaty\Robot\AuthClient $auth 机器人身份验证
 * @property \Weiliu\Open\Chaty\Robot\RoomClient $room 机器人群
 * @property \Weiliu\Open\Chaty\Robot\ContactClient $contact 机器人联系人
 */
class Robot extends Client
{
    /**
     * @param $property
     *
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function __get($property)
    {
        if (isset($this->app["robot.{$property}"])) {
            return $this->app["robot.{$property}"];
        }

        throw new InvalidArgumentException(sprintf('No robot service named "%s".', $property));
    }
}