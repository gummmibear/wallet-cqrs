<?php
/**
 * Created by PhpStorm.
 * User: gbear
 * Date: 26.02.17
 * Time: 23:45
 */

namespace App\Service\EventStore;

use Interop\Container\ContainerInterface;
use Domain\Wallet\EventSourcing\WalletRepository;
use Broadway\EventHandling\SimpleEventBus;

class WalletRepositoryFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new WalletRepository(
            $container->get('WalletEventStore'),
            $container->get(SimpleEventBus::class)
        );
    }
}