<?php
/**
 * Created by PhpStorm.
 * User: gbear
 * Date: 26.02.17
 * Time: 23:17
 */

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