<?php
namespace App\Service\Command;


use Domain\Wallet\Commands\MoneyCommandHandler;
use Domain\Wallet\EventSourcing\TransactionRepository;
use Domain\Wallet\EventSourcing\WalletRepository;
use Interop\Container\ContainerInterface;

class MoneyCommandHandlerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $x = new MoneyCommandHandler(
            $container->get(WalletRepository::class),
            $container->get(TransactionRepository::class)
        );

        return $x;
    }
}