<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

namespace Hooklife\HyperfAliyunAmqp;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
                \Hyperf\Amqp\Pool\AmqpConnectionPool::class => AliyunAmqpConnectionPool::class
            ],
            'commands'     => [
            ],
            'annotations'  => [
            ],
        ];
    }
}
