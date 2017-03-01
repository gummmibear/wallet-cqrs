<?php

namespace App\Action;

use Broadway\CommandHandling\SimpleCommandBus;
use Interop\Container\ContainerInterface;

class ChangeTransactionActionFactory
{
    public function __invoke(ContainerInterface $container)
    {
        /** @var SimpleCommandBus $commandBus */
        $commandBus = $container->get(SimpleCommandBus::class);

        return new ChangeTransactionAction($commandBus);
    }
}
