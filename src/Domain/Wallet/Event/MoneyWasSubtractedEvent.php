<?php

namespace Domain\Wallet\Event;

class MoneyWasSubtractedEvent extends MoneyEvent
{
    /**
     * @return mixed The object instance
     */
    public static function deserialize(array $data)
    {
        return new MoneyWasSubtractedEvent(
            $data['transactionId'],
            $data['userId'],
            $data['amount'],
            $data['title'],
            new \DateTime($data['dateTime'])
        );
    }
}
