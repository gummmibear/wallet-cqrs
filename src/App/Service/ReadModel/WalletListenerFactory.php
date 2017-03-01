<?php

namespace App\Service\ReadModel;

use Domain\Wallet\Listeners\WalletListener;
use Domain\Wallet\ReadModel\WalletRepository;
use Interop\Container\ContainerInterface;

class WalletListenerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new WalletListener($container->get(WalletRepository::class));
    }
}
