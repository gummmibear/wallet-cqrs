<?php

namespace Domain\Wallet\Commands;

abstract class TransactionCommand
{
    private $transactionId;
    private $userId;

    public function __construct(string $transactionId, int $userId)
    {
        $this->transactionId = $transactionId;
        $this->userId = $userId;
    }

    /**
     * @return string
     */
    public function getTransactionId(): string
    {
        return $this->transactionId;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }
}
