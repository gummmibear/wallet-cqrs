<?php

namespace Domain\Wallet\ReadModel;


use Broadway\ReadModel\ReadModelInterface;

class Transaction implements ReadModelInterface, \JsonSerializable
{
    private $transactionId;
    private $userId;
    private $amount;
    private $title;
    private $type;
    private $dateTime;

    public function __construct(
        string $transactionId,
        int $userId,
        float $amount,
        int $type,
        string $title,
        \DateTime $dateTime
    )
    {
        $this->transactionId = $transactionId;
        $this->userId = $userId;
        $this->amount= $amount;
        $this->title = $title;
        $this->type = $type;
        $this->dateTime = $dateTime;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->transactionId;
    }

    /**
     * @param float $amount
     */
    public function setAmount(float $amount)
    {
        $this->amount = $amount;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @param \DateTime $dateTime
     */
    public function setDateTime(\DateTime $dateTime)
    {
        $this->dateTime = $dateTime;
    }

    public function setType(int $type)
    {
        $this->type;
    }

    public function serialize()
    {
        return [
            '_id' => (string) $this->transactionId,
            'userId' => (string) $this->userId,
            'amount' => $this->amount,
            'type' => $this->type,
            'title' => $this->title,
            'dateTime' => $this->dateTime->format(DATE_ISO8601)
        ];
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize()
    {
        return [
            'transactionId' => (string) $this->transactionId,
            'userId' => (string) $this->userId,
            'amount' => \Domain\Wallet\Helper\MoneyHelper::formatMoney($this->amount*(int)$this->type),
            'type' => $this->type,
            'title' => $this->title,
            'dateTime' => $this->dateTime->format(DATE_ISO8601)
        ];
    }
}