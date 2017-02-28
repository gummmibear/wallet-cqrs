<?php
/**
 * Created by PhpStorm.
 * User: gbear
 * Date: 25.02.17
 * Time: 18:28
 */

namespace Domain\Wallet\Commands;


class TransactionDateChangeCommand extends TransactionCommand
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
}