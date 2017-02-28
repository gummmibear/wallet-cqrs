<?php

namespace Domain\Wallet\Event;
use Broadway\Serializer\SerializableInterface;

/**
 * Created by PhpStorm.
 * User: gbear
 * Date: 17.02.17
 * Time: 01:17
 */
abstract class MoneyEvent implements SerializableInterface
{
    protected $transactionId;
    protected $userId;
    protected $amount;
    protected $title;
    protected $dateTime;

    public function __construct(
        string $transactionId,
        string $userId,
        int $amount,
        string $title,
        \DateTime $dateTime
    )
    {
        $this->transactionId = $transactionId;
        $this->userId = $userId;
        $this->amount = $amount;
        $this->title = $title;
        $this->dateTime = $dateTime;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getAmount():int
    {
        return $this->amount;
    }

    public function getTransactionId():string
    {
        return $this->transactionId;
    }

    /**
     * @return array
     */
    public function serialize()
    {
        return [
            'transactionId' => $this->transactionId,
            'userId' => $this->userId,
            'amount' => $this->amount,
            'title' => $this->title,
            'dateTime' => $this->dateTime->format(DATE_ISO8601)
        ];
    }
}