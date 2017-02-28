<?php
/**
 * Created by PhpStorm.
 * User: gbear
 * Date: 28.02.17
 * Time: 02:26
 */

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