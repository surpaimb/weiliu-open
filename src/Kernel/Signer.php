<?php

namespace Weiliu\Open\Kernel;

class Signer
{
    public function sign(array $params): string
    {
        sort($params, SORT_STRING);

        return sha1(implode($params));
    }

    public function verify(string $signature, array $params): bool
    {
        return $signature == $this->sign($params);
    }
}