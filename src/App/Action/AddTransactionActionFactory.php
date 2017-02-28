<?php

namespace App\Action;

use Broadway\CommandHandling\SimpleCommandBus;
use Interop\Container\ContainerInterface;

class AddTransactionActionFactory
{
    public function __invoke(ContainerInterface $container)
    {
        /** @var SimpleCommandBus $commandBus */
        $commandBus = $container->get(SimpleCommandBus::class);

        return new AddTransactionAction($commandBus);
    }
}
