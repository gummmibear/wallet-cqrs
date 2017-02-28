<?php

namespace Domain\Wallet\Commands;

class TransactionAmountChangeCommand extends TransactionCommand
{
    private $amount;

    public function __construct($transactionId, $userId, int $amount)
    {
        parent::__construct($transactionId, $userId);
        $this->amount = $amount;
    }

    /**
     * @return float
     */
    public function getAmount(): int
    {
        return $this->amount;
    }
}