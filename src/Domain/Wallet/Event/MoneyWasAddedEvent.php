<?php

namespace Domain\Wallet\Event;

class MoneyWasAddedEvent extends MoneyEvent
{
    /**
     * @return mixed The object instance
     */
    public static function deserialize(array $data)
    {
        return new MoneyWasAddedEvent(
            $data['transactionId'],
            $data['userId'],
            $data['amount'],
            $data['title'],
            new \DateTime($data['dateTime'])
        );
    }
}
