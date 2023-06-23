<?php

namespace Weiliu\Open\Cps\Coupon;

use Weiliu\Open\Cps\BaseClient;

class CouponClient extends BaseClient
{
    /**
     * 优惠券列表
     *
     * @param int $page
     * @param int $perPage
     * @param array $with
     * @param array $query
     *
     * @return array|object|\Psr\Http\Message\ResponseInterface|string|\Weiliu\Open\Kernel\Support\Collection
     */
    public function list(int $page = 1, int $perPage = 20, array $with = [], array $query = [])
    {
        $query += [
            'sort_by' => 'created_at',
            'descending' => 'desc',
            'page' => $page,
            'per_page' => $perPage,
        ];

        if ($with) {
            $query['include'] = implode(',', $with);
        }

        return $this->httpGet('coupons', $query);
    }

    /**
     * 优惠券详情
     *
     * @param string|int $id
     * @param array $with
     * @param array $query
     *
     * @return array|object|\Psr\Http\Message\ResponseInterface|string|\Weiliu\Open\Kernel\Support\Collection
     */
    public function find($id, array $with = [], array $query = [])
    {
        if ($with) {
            $query['include'] = implode(',', $with);
        }

        return $this->httpGet("coupons/{$id}", $query);
    }

    /**
     * 查询淘宝优惠券详情
     *
     * 如果通过 itemId 查询则默认返回金额大的
     *
     * @param string|int $id activityId 或者 itemId
     * @param array $with
     * @param array $query
     *
     * @return array|object|\Psr\Http\Message\ResponseInterface|string|\Weiliu\Open\Kernel\Support\Collection
     */
    public function findTB($id, array $with = [], array $query = [])
    {
        if ($with) {
            $query['include'] = implode(',', $with);
        }

        return $this->httpGet("coupons/tb_{$id}", $query);
    }
}