<?php

namespace App\Action;

use Domain\Wallet\Commands\AddMoneyCommand;
use Domain\Wallet\Commands\SubMoneyCommand;
use Domain\Wallet\ReadModel\Transaction;

class MoneyCommandFactory
{
    public static function create(int $userId, int $type, int $amount, string $title)
    {
        switch ($type) {
            case Transaction::INCOME_TYPE:
                return new AddMoneyCommand(
                    uniqid(),
                    $userId,
                    $amount,
                    $title
                );

            case Transaction::OUTCOME_TYPE:
                return new SubMoneyCommand(
                    uniqid(),
                    $userId,
                    $amount,
                    $title
                );
            default:
                throw new \Exception(sprintf('Cant handle transaction with type: %s', $type));
        }
    }
}