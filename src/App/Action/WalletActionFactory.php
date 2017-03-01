<?php

namespace App\Action;

use App\DataProvider\WalletDataProvider;
use Interop\Container\ContainerInterface;

class WalletActionFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new WalletAction(
            $container->get(WalletDataProvider::class)
        );
    }
}
