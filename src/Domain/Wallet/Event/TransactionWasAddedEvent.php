<?php

namespace Domain\Wallet\Event;

class TransactionWasAddedEvent extends TransactionEvent
{
    private $amount;
    private $title;
    private $type;
    private $dateTime;

    public function __construct($transactionId, $userId, $amount, $type, $title, \DateTime $dateTime)
    {
        parent::__construct($transactionId, $userId);
        $this->amount = $amount;
        $this->type = $type;
        $this->title = $title;
        $this->dateTime = $dateTime;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return \DateTime
     */
    public function getDateTime(): \DateTime
    {
        return $this->dateTime;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed The object instance
     */
    public static function deserialize(array $data)
    {
        return new self(
            $data['transactionId'],
            $data['userId'],
            $data['amount'],
            $data['type'],
            $data['title'],
            new \DateTime($data['dateTime'])
        );
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
            'type' => $this->type,
            'title' => $this->title,
            'dateTime' => $this->dateTime->format(DATE_ISO8601)
        ];
    }
}
