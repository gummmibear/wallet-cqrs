<?php

namespace App\Service\ReadModel;


/**
 * Created by PhpStorm.
 * User: gbear
 * Date: 26.02.17
 * Time: 23:07
 */

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