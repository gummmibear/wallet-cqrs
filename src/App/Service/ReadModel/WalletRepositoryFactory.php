<?php

namespace App\Service\ReadModel;

use Interop\Container\ContainerInterface;
use Domain\Wallet\ReadModel\WalletRepository;
use MongoDB\Client;

class WalletRepositoryFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $collection = $container->get(Client::class)->wallet->userWallet;
        return new WalletRepository($collection);
    }
}
