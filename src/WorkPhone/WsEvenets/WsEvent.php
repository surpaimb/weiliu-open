<?php

namespace Weiliu\Open\WorkPhone\WsEvenets;

use Ramsey\Uuid\Uuid;

class WsEvent
{
    public $id;

    public function id()
    {
        return $this->id ?: Uuid::uuid4()->toString();
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function event()
    {
        return null;
    }

    public function data()
    {
        return (object)[];
    }

    public function toArray()
    {
        return [
            'id' => $this->id(),
            'event' => $this->event(),
            'data' => json_encode($this->data(), JSON_UNESCAPED_UNICODE),
        ];
    }
}