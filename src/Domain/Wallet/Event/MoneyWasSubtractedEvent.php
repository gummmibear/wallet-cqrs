<?php

namespace Domain\Wallet\Event;
/**
 * Created by PhpStorm.
 * User: gbear
 * Date: 17.02.17
 * Time: 00:51
 */
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