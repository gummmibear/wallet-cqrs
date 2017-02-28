<?php

namespace Domain\Wallet\EventSourcing;

use Broadway\EventSourcing\EventSourcingRepository;
use Broadway\EventStore\EventStoreInterface;
use Broadway\EventHandling\EventBusInterface;
use Broadway\EventSourcing\AggregateFactory\PublicConstructorAggregateFactory;
use Domain\Wallet\Wallet;

class WalletRepository extends EventSourcingRepository
{
    public function __construct(
        EventStoreInterface $eventStore,
        EventBusInterface $eventBus
    )
    {
        parent::__construct(
            $eventStore,
            $eventBus,
            Wallet::class,
            new PublicConstructorAggregateFactory()
        );
    }
}