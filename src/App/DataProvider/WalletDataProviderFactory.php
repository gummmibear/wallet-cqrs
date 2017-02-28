<?php
/**
 * Created by PhpStorm.
 * User: gbear
 * Date: 28.02.17
 * Time: 02:28
 */

namespace App\DataProvider;


use Domain\Wallet\ReadModel\WalletRepository;
use Psr\Container\ContainerInterface;

class WalletDataProviderFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new WalletDataProvider(
            $container->get(WalletRepository::class)
        );
    }
}