<?php
/**
 * Created by PhpStorm.
 * User: enoch
 * Date: 16-5-3
 * Time: 下午5:15
 */

namespace enochzg\aliyun;

use enochzg\aliyun\sts\Sts;
use enochzg\aliyun\OSS\OssClient;
use yii\base\Component;

class Aliyun extends Component
{
    public $accessKeyId;
    public $accessSecret;
    public $durationSeconds;
    public $defaultRoleArn;
    public $endPoint;
    public $defaultBucketName;

    /**
     * 生成STS临时凭证
     * @param $sessionName
     * @param int $durationSeconds
     * @return mixed
     */
    public function generateSTSToken($sessionName, $durationSeconds = 3600)
    {
        $sts = new Sts();
        $sts->accessKeyId = $this->accessKeyId;
        $sts->format = 'JSON';
        $sts->accessSecret = $this->accessSecret;
        $sts->defaultRoleArn = $this->defaultRoleArn;
        $sts->durationSeconds = $durationSeconds;
        return $sts->generate($sessionName);
    }

    /**
     * 上传文件
     * @param $objectName
     * @param $localFilePath
     * @param null $bucketName
     * @return null
     */
    public function uploadFile($objectName, $localFilePath, $bucketName = null)
    {
        $ossClient = new OssClient($this->accessKeyId, $this->accessSecret, $this->endPoint);
        $bucketName = $bucketName ? $bucketName : $this->defaultBucketName;
        return $ossClient->uploadFile($bucketName, $objectName, $localFilePath);
    }
}