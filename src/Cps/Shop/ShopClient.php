<?php

namespace Weiliu\Open\Cps\Shop;

use Weiliu\Open\Cps\BaseClient;

class ShopClient extends BaseClient
{
    /**
     * 店铺列表
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

        return $this->httpGet('shops', $query);
    }

    /**
     * 店铺详情
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

        return $this->httpGet("shops/{$id}", $query);
    }

    /**
     * 查询淘宝店铺详情
     *
     * @param string|int $id sellerId
     *
     * @param $id
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

        return $this->httpGet("shops/tb_{$id}", $query);
    }
}