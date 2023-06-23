<?php

namespace Weiliu\Open\Support\File;

use Weiliu\Open\Support\BaseClient;

class File extends BaseClient
{
    /**
     * 文件上传
     *
     * @param $filename
     * @param array $data 其他数据
     * @param null|string $bucket 根目录-推荐使用项目名
     *
     * $data 值例如:
     *
     * - 添加 m4a 转码 mp3 任务
     * job = m4a2mp3
     * job_metadata = 自定义数据只能是字符串(回调时原样带回)
     * job_notify_url = 转码完成通知地址
     *
     * @return array
     */
    public function upload($filename, array $data = [], ?string $bucket = null)
    {
        $data += [
            'bucket' => $bucket ?: $this->app->getConfig()['bucket'],
        ];

        return $this->httpUpload(
            'files',
            is_array($filename) ? $filename : ['file' => $filename],
            $data
        );
    }

    public function sts() {
        return $this->httpPost("files/sts");
    }
}