<?php

namespace App\DataProvider;

use Domain\Wallet\ReadModel\TransactionRepository;
use Interop\Container\ContainerInterface;

class TransactionDataProviderFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new TransactionDataProvider(
            $container->get(TransactionRepository::class)
        );
    }
}