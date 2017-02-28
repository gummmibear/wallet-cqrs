<?php

namespace App\Service;


use Broadway\EventHandling\SimpleEventBus;
use Domain\Wallet\Listeners\TransactionListener;
use Domain\Wallet\Listeners\WalletListener;
use Interop\Container\ContainerInterface;

class SimpleEventBusFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $simpleEventBus = new SimpleEventBus();
        $simpleEventBus->subscribe($container->get(WalletListener::class));
        $simpleEventBus->subscribe($container->get(TransactionListener::class));

        return $simpleEventBus;
    }
}