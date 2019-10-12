## 安装
```
composer require hooklife/hyperf-aliyun-amqp
```

## 使用方法

复制 aliyun_amqp.php 到 config/autoload
```php
<?php
return [
    'default' => [
        'endpoint'          => env('AMQP_ENDPOINT', ''),
        'owner_id'          => env('AMQP_OWNER_ID'),
        'access_key_id'     => env('AMQP_AK_ID'),
        'access_key_secret' => env('AMQP_AK_SECRET'),
    ],
];
```
