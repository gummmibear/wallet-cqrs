<?php
/**
 * Created by PhpStorm.
 * User: gbear
 * Date: 26.02.17
 * Time: 22:58
 */

namespace App\Service;



use Interop\Container\ContainerInterface;
use MongoDB\Client;

class MongoConnectionFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new Client("mongodb://127.0.0.1:27017");
    }
}