<?php

namespace Domain\Wallet\EventSourcing;

use Broadway\EventHandling\EventBusInterface;
use Broadway\EventSourcing\AggregateFactory\PublicConstructorAggregateFactory;
use Broadway\EventSourcing\EventSourcingRepository;
use Broadway\EventStore\EventStoreInterface;
use Domain\Wallet\Transaction;

class TransactionRepository extends EventSourcingRepository
{
    public function __construct(
        EventStoreInterface $eventStore,
        EventBusInterface $eventBus
    ) {
        parent::__construct(
            $eventStore,
            $eventBus,
            Transaction::class,
            new PublicConstructorAggregateFactory()
        );
    }
}
