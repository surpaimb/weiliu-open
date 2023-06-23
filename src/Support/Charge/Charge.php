<?php

namespace Weiliu\Open\Support\Charge;

use Symfony\Component\HttpFoundation\Request;
use Weiliu\Open\Support\BaseClient;

class Charge extends BaseClient
{
    /**
     * 获取可用订单号
     *
     * @param string $channel 支付渠道
     *
     * @return mixed|null
     */
    public function getAvailableNo(string $channel)
    {
        return $this->httpGet('charges/available_no?channel=' . $channel)['no'] ?? null;
    }

    /**
     * 创建支付凭据
     *
     * @param string $channel 支付渠道
     * @param string $orderNo 订单号
     * @param int $amount 支付金额分
     * @param string $body 支付描述
     * @param array $extra 扩展数据
     *
     * $extra 说明:
     *
     * 小程序渠道/微信H5支付须携带 openid
     *
     * @param array $metadata 用户指定数据
     * @param array $data
     *
     * @return array
     */
    public function create(
        string $channel,
        string $orderNo,
        int $amount,
        string $body,
        string $clientIp = null,
        array $extra = null,
        array $metadata = null,
        array $data = []
    )
    {
        $data += [
            'channel' => $channel,
            'order_no' => $orderNo,
            'amount' => $amount,
            'body' => $body,
            'client_ip' => $clientIp ?: Request::createFromGlobals()->getClientIp(),
            'extra' => $extra,
            'metadata' => $metadata,
        ];

        return $this->httpPost('charges', $data);
    }

    /**
     * 查询支付凭据
     *
     * @param $id
     *
     * @return array
     */
    public function find($id)
    {
        return $this->httpGet("charges/{$id}");
    }

    /**
     * 撤销支付凭据
     *
     * @param $id
     *
     * @return array
     */
    public function reverse($id)
    {
        return $this->httpPost("charges/{$id}/reverse");
    }
}