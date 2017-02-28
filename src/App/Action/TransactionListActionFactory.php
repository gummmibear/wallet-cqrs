<?php

namespace App\Action;


use App\DataProvider\TransactionDataProvider;
use Interop\Container\ContainerInterface;

class TransactionListActionFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new TransactionListAction(
            $container->get(TransactionDataProvider::class)
        );
    }
}