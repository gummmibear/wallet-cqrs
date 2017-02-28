<?php

namespace App\Service\EventStore;


use Broadway\EventHandling\SimpleEventBus;
use Domain\Wallet\EventSourcing\TransactionRepository;
use Interop\Container\ContainerInterface;

class TransactionRepositoryFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new TransactionRepository(
            $container->get('TransactionEventStore'),
            $container->get(SimpleEventBus::class)
        );
    }
}