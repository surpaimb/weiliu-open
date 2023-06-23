<?php

namespace Weiliu\Open\Cps\Category;

use Weiliu\Open\Cps\BaseClient;

class CategoryClient extends BaseClient
{
    /**
     * 优惠券列表
     *
     * @param int $page
     * @param int $perPage
     * @param array $with
     * @param array $query
     *
     * @return array
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

        return $this->httpGet('categories', $query);
    }

    /**
     * @param $data
     *
     * @return array
     */
    public function create($data)
    {
        return $this->httpPost('categories', $data);
    }

    /**
     * @param $id
     * @param $data
     *
     * @return array
     */
    public function update($id, $data)
    {
        return $this->httpPut("categories/{$id}", $data);
    }

    /**
     * @param $id
     *
     * @return array
     */
    public function delete($id)
    {
        return $this->httpDelete("categories/{$id}");
    }
}