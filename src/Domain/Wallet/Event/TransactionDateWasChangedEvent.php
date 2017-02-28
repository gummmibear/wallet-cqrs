<?php

namespace Domain\Wallet\Event;

class TransactionDateWasChangedEvent extends TransactionEvent
{
    private $dateTime;

    public function __construct(string $transactionId, int $userId, \DateTime $dateTime)
    {
        parent::__construct($transactionId, $userId);
        $this->dateTime = $dateTime;
    }

    /**
     * @return \DateTime
     */
    public function getDateTime(): \DateTime
    {
        return $this->dateTime;
    }

    /**
     * @return mixed The object instance
     */
    public static function deserialize(array $data)
    {
        return new self(
            $data['transactionId'],
            $data['userId'],
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
            'dateTime' => $this->dateTime->format(DATE_ISO8601)
        ];
    }
}