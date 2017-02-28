<?php

namespace Domain\Wallet\Event;
use Broadway\Serializer\SerializableInterface;

/**
 * Created by PhpStorm.
 * User: gbear
 * Date: 17.02.17
 * Time: 01:23
 */
abstract class TransactionEvent implements SerializableInterface
{
    protected $transactionId;
    protected $userId;

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