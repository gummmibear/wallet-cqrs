<?php
/**
 * Created by PhpStorm.
 * User: gbear
 * Date: 26.02.17
 * Time: 23:12
 */

namespace App\Service\ReadModel;


use Domain\Wallet\ReadModel\TransactionRepository;
use Interop\Container\ContainerInterface;
use MongoDB\Client;
use MongoDB\Collection;

class TransactionRepositoryFactory
{
    public function __invoke(ContainerInterface $container)
    {
        /** @var Collection $collection */
        $collection = $container->get(Client::class)->wallet->userTransaction;
        return new TransactionRepository($collection);
    }
}