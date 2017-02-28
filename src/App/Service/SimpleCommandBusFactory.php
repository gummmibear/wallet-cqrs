<?php

namespace App\Service;


use Broadway\CommandHandling\SimpleCommandBus;
use Domain\Wallet\Commands\MoneyCommandHandler;
use Domain\Wallet\Commands\TransactionCommandHandler;
use Interop\Container\ContainerInterface;

class SimpleCommandBusFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $simpleCommandBus = new SimpleCommandBus();

        $simpleCommandBus->subscribe($container->get(MoneyCommandHandler::class));
        $simpleCommandBus->subscribe($container->get(TransactionCommandHandler::class));

        return $simpleCommandBus;
    }
}