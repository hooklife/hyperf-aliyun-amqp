<?php


namespace Hooklife\HyperfAliyunAmqp;


use Hyperf\Amqp\Connection;
use Hyperf\Amqp\Pool\AmqpConnectionPool;
use Hyperf\Contract\ConfigInterface;
use Hyperf\Contract\ConnectionInterface;
use Psr\Container\ContainerInterface;

class AliyunAmqpConnectionPool extends AmqpConnectionPool
{
    private $aliyunAMQPConfig;

    public function __construct(ContainerInterface $container, string $name)
    {
        $config = $container->get(ConfigInterface::class);
        $key = sprintf('aliyun_amqp.%s', $name);
        $this->aliyunAMQPConfig = $config->get($key);

        parent::__construct($container, $name);
    }

    protected function createConnection(): ConnectionInterface
    {
        $this->config['host'] = $this->aliyunAMQPConfig['endpoint'];
        $this->config['port'] = 5672;
        $this->config['user'] = $this->getUser();
        $this->config['password'] = $this->getPassword();

        return new Connection($this->container, $this, $this->config);
    }


    private function getUser()
    {
        $t = '0:' . $this->aliyunAMQPConfig['owner_id'] . ':' . $this->aliyunAMQPConfig['access_key_id'];
        return base64_encode($t);
    }

    private function getPassword()
    {
        $ts = (int)(microtime(true) * 1000);
        $value = utf8_encode($this->aliyunAMQPConfig['access_key_secret']);
        $key = utf8_encode((string)$ts);
        $sig = strtoupper(hash_hmac('sha1', $value, $key, FALSE));
        return base64_encode(utf8_encode($sig . ':' . $ts));
    }
}