<?php

namespace Weiliu\Open\Cps\Taobaoke;

use Weiliu\Open\Cps\BaseClient;

class TaobaokeClient extends BaseClient
{
    /**
     * @param $itemId
     * @param null $activityId
     *
     * @return array|object|\Psr\Http\Message\ResponseInterface|string|\Weiliu\Open\Kernel\Support\Collection
     */
    public function find($itemId, $activityId = null)
    {
        $query = [
            'item_id' => $itemId,
            'activity_id' => $activityId,
        ];

        return $this->httpGet('taobaoke/finder', $query);
    }
}