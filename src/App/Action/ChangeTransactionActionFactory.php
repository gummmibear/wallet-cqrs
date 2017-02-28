<?php
/**
 * Created by PhpStorm.
 * User: gbear
 * Date: 27.02.17
 * Time: 02:13
 */

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