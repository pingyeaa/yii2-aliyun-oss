# yii2-aliyun-oss
阿里云OSS云存储SDK封装

# 安装
```bash
composer require enochzg/yii2-aliyun-oss
```

# 配置
```php
<?php

  'aliyun' => [
    'class' => 'enochzg\aliyun\Aliyun',
    'accessKeyId' => '',  //在阿里云的控制台可以创建、查询
    'accessSecret' => '',   //在阿里云的控制台可以创建、查询
    'defaultRoleArn' => '',   //在阿里云的控制台可以创建、查询
    'defaultBucketName' => '',  //默认操作哪个BucketName
    'endPoint' => 'oss-cn-shenzhen.aliyuncs.com',
  ],
  
?>
```

# 使用方式
```php
<?php
  
  //生成临时授权凭证
  $sessionName = '99';
  $durationSeconds = 3600; //过期时间
  $token = yii::$app->aliyun->generateSTSToken($sessionName, $durationSeconds);
  
  //上传文件，默认操作defaultBucketName
  yii::$app->aliyun->uploadFile('enoch-test', '/home/enoch/图片/2.png');
  
  //单个文件删除，默认操作defaultBucketName
  yii::$app->aliyun->deleteObject('object-name', 'bucketName');
  
  //批量删除文件，默认操作defaultBucketName
  yii::$app->aliyun->deleteObjects(['path/58ca9c-f', 'path/929171a3']);

?>
```
