<?php

namespace Domain\Wallet\Commands;

class MoneyCommand
{
    private $transactionId;
    private $userId;
    private $amount;
    private $title;

    public function __construct($transactionId, $userId, $amount, $title)
    {
        $this->transactionId = $transactionId;
        $this->userId = $userId;
        $this->amount = $amount;
        $this->title = $title;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getTransactionId()
    {
        return $this->transactionId;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function getTitle()
    {
        return $this->title;
    }
}