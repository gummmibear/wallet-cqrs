<?php

namespace App\Service;

use Interop\Container\ContainerInterface;
use Doctrine\DBAL\DriverManager;

class DBConnectionFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $params = $container->get('config');

        return DriverManager::getConnection((array) $params);
    }
}
