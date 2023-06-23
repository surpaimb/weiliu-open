<?php

namespace Weiliu\Open\Support\Auth;

use SDK\Kernel\Signer as BaseSigner;

class Signer extends BaseSigner
{
    public function sign(array $params, ?string $secretKey = null): string
    {
        sort($params, SORT_STRING);

        return sha1(implode($params));
    }

    public function verify(string $signature, array $params, ?string $secretKey = null): bool
    {
        return $signature == $this->sign($params);
    }
}