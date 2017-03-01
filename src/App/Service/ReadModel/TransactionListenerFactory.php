<?php

namespace App\Service\ReadModel;

use Domain\Wallet\Listeners\TransactionListener;
use Domain\Wallet\ReadModel\TransactionRepository;
use Interop\Container\ContainerInterface;

class TransactionListenerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new TransactionListener($container->get(TransactionRepository::class));
    }
}
