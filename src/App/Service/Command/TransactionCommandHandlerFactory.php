<?php
/**
 * Created by PhpStorm.
 * User: gbear
 * Date: 26.02.17
 * Time: 23:55
 */

namespace App\Service\Command;


use Domain\Wallet\Commands\TransactionCommandHandler;
use Domain\Wallet\EventSourcing\TransactionRepository;
use Domain\Wallet\EventSourcing\WalletRepository;
use Interop\Container\ContainerInterface;

class TransactionCommandHandlerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new TransactionCommandHandler(
            $container->get(WalletRepository::class),
            $container->get(TransactionRepository::class)
        );
    }
}