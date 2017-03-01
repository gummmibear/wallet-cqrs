<?php

namespace App\Action;

use App\DataProvider\TransactionDataProvider;
use Interop\Container\ContainerInterface;

class TransactionStatsActionFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new TransactionStatsAction(
            $container->get(TransactionDataProvider::class)
        );
    }
}
