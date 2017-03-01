<?php

namespace App\Service\EventStore;

use Broadway\EventStore\DBALEventStore;
use Broadway\Serializer\SimpleInterfaceSerializer;
use Doctrine\DBAL\Connection;
use Interop\Container\ContainerInterface;

class TransactionEventStoreFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new DBALEventStore(
            $container->get(Connection::class),
            $container->get(SimpleInterfaceSerializer::class),
            $container->get(SimpleInterfaceSerializer::class),
            'transaction_events'
        );
    }
}
