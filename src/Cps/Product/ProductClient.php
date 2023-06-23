<?php

namespace Weiliu\Open\Cps\Product;

use Weiliu\Open\Cps\BaseClient;

class ProductClient extends BaseClient
{
    /**
     * 商品列表
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

        return $this->httpGet('products', $query);
    }

    /**
     * 商品详情
     *
     * @param string|int $id
     * @param array $with
     * @param array $query
     *
     * @return array|object|\Psr\Http\Message\ResponseInterface|string|\Weiliu\Open\Kernel\Support\Collection
     */
    public function find($id, array $with = ['coupons'], array $query = [])
    {
        if ($with) {
            $query['include'] = implode(',', $with);
        }

        return $this->httpGet("products/{$id}", $query);
    }

    /**
     * 查询淘宝商品详情
     *
     * @param string|int $id itemId
     * @param array $with
     * @param array $query
     *
     * @return array|object|\Psr\Http\Message\ResponseInterface|string|\Weiliu\Open\Kernel\Support\Collection
     */
    public function findTB($id, array $with = ['coupons'], array $query = [])
    {
        if ($with) {
            $query['include'] = implode(',', $with);
        }

        return $this->httpGet("products/tb_{$id}", $query);
    }
}