<?php

namespace App\Service;

use Interop\Container\ContainerInterface;
use MongoDB\Client;

class MongoConnectionFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $params = $container->get('config');

        if (!isset($params['mongodb'])) {
            throw new \RuntimeException('mongodb config not found');
        }

        return new Client($params['mongodb']);
    }
}
