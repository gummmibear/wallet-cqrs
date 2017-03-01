<?php

namespace Domain\Wallet\ReadModel;

use Broadway\ReadModel\ReadModelInterface;
use Domain\Wallet\Helper\MoneyHelper;

class Wallet implements ReadModelInterface, \JsonSerializable
{
    private $userId;
    private $accountBalance = 0;
    private $transactionCount = 0;

    public function __construct(int $userId, int $accountBalance, int $transactionCount)
    {
        $this->userId = $userId;
        $this->accountBalance = $accountBalance;
        $this->transactionCount = $transactionCount;
    }

    /**
     * @param mixed $accountBalance
     */
    public function setAccountBalance($accountBalance)
    {
        $this->accountBalance = $accountBalance;
    }

    public function setTransactionCount($transactionCount)
    {
        $this->transactionCount = $transactionCount;
    }

    public function incrementTransactionCount()
    {
        $this->transactionCount++;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->userId;
    }

    public function getAccountBalance()
    {
        return $this->accountBalance;
    }

    /**
     * @return int
     */
    public function getTransactionCount(): int
    {
        return $this->transactionCount;
    }

    public function serialize()
    {
        return [
            '_id' => (string) $this->userId,
            'accountBalance' => $this->accountBalance,
            'transactionCount' => $this->transactionCount
        ];
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return [
            'userId' => (string) $this->userId,
            'accountBalance' => MoneyHelper::formatMoney($this->accountBalance),
            'transactionCount' => $this->transactionCount
        ];
    }
}
