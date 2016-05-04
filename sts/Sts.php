<?php

namespace enochzg\aliyun\sts;

include "aliyun-php-sdk-core/Config.php";
include "AssumeRoleRequest.php";

class Sts
{
    public $accessKeyId;
    public $accessSecret;
    public $format;
    public $defaultRoleArn;
    public $durationSeconds;
    protected $policy = null;

    public function generate($sessionName)
    {
        $iClientProfile = \DefaultProfile::getProfile("cn-hangzhou", $this->accessKeyId, $this->accessSecret);
        $client = new \DefaultAcsClient($iClientProfile);

        //进一步限制角色的使用权限
        //默认设置为所有权限
        if(!$this->policy) {
            $this->policy = '
                {
                  "Statement": [
                    {
                      "Action": [
                        "oss:*"
                      ],
                      "Effect": "Allow",
                      "Resource": "*"
                    }
                  ],
                  "Version": "1"
                }
            ';
        }

        $request = new \AssumeRoleRequest();
        $request->setFormat($this->format);

        // RoleSessionName即临时身份的会话名称，用于区分不同的临时身份
        // 您可以使用您的客户的ID作为会话名称
        $request->setRoleSessionName($sessionName);
        $request->setRoleArn($this->defaultRoleArn);
        $request->setPolicy($this->policy);
        $request->setDurationSeconds($this->durationSeconds);
        $response = $client->doAction($request);
        return $response->getBody();
    }

    public function setPolicy($policy)
    {
        $this->policy = $policy;
    }

    public function setRoleArn($roleArn)
    {
        $this->defaultRoleArn = $roleArn;
    }
}