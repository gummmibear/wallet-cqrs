<?php
/**
 * Created by PhpStorm.
 * User: gbear
 * Date: 26.02.17
 * Time: 23:41
 */

namespace App\Service\EventStore;


use Broadway\EventStore\DBALEventStore;
use Broadway\Serializer\SimpleInterfaceSerializer;
use Doctrine\DBAL\Connection;
use Interop\Container\ContainerInterface;

class WalletEventStoreFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new DBALEventStore(
            $container->get(Connection::class),
            $container->get(SimpleInterfaceSerializer::class),
            $container->get(SimpleInterfaceSerializer::class),
            'wallet_events'
        );
    }
}