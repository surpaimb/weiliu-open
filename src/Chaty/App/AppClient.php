<?php

namespace Weiliu\Open\Chaty\App;

use Weiliu\Open\Chaty\BaseClient;

/**
 * 应用
 */
class AppClient extends BaseClient
{
    /**
     * 应用信息
     *
     * @param int $id 主键ID
     * @param array $query
     *
     * @return array|object|\Psr\Http\Message\ResponseInterface|string|\Weiliu\Open\Kernel\Support\Collection
     */
    public function info(array $query = [])
    {
        return $this->httpGet('app', $query);
    }

    /**
     * 更新应用
     *
     * @param array $data
     *
     * @return array|object|\Psr\Http\Message\ResponseInterface|string|\Weiliu\Open\Kernel\Support\Collection
     */
    public function update(array $data)
    {
        return $this->httpPut('app', $data);
    }

    /**
     * 更新应用名
     *
     * @param string $name
     *
     * @return array|object|\Psr\Http\Message\ResponseInterface|string|\Weiliu\Open\Kernel\Support\Collection
     */
    public function updateName(string $name)
    {
        return $this->update([
            'name' => $name
        ]);
    }

    /**
     * 更新设备通知地址
     *
     * @param string $notifyUrl
     *
     * @return array|object|\Psr\Http\Message\ResponseInterface|string|\Weiliu\Open\Kernel\Support\Collection
     */
    public function updateDeviceNotifyUrl(string $notifyUrl)
    {
        return $this->update([
            'device_notify_url' => $notifyUrl
        ]);
    }

    /**
     * 更新设备通知地址(钉钉机器人)
     *
     * @param string $dingtalkAccessToken 为 null 则是移除
     *
     * @return array|object|\Psr\Http\Message\ResponseInterface|string|\Weiliu\Open\Kernel\Support\Collection
     */
    public function updateDeviceNotifyDingtalkAccessToken(string $dingtalkAccessToken = null)
    {
        return $this->update([
            'device_notify_dingtalk_access_token' => $dingtalkAccessToken
        ]);
    }

    /**
     * 更新机器人通知地址
     *
     * @param string $notifyUrl
     *
     * @return array|object|\Psr\Http\Message\ResponseInterface|string|\Weiliu\Open\Kernel\Support\Collection
     */
    public function updateRobotNotifyUrl(string $notifyUrl)
    {
        return $this->update([
            'robot_notify_url' => $notifyUrl
        ]);
    }

    /**
     * 更新机器人通知地址(钉钉机器人)
     *
     * @param string $dingtalkAccessToken 为 null 则是移除
     *
     * @return array|object|\Psr\Http\Message\ResponseInterface|string|\Weiliu\Open\Kernel\Support\Collection
     */
    public function updateRobotNotifyDingtalkAccessToken(string $dingtalkAccessToken = null)
    {
        return $this->update([
            'robot_notify_dingtalk_access_token' => $dingtalkAccessToken
        ]);
    }
}