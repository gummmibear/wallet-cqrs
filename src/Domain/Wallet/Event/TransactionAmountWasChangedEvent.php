<?php

namespace Domain\Wallet\Event;
/**
 * Created by PhpStorm.
 * User: gbear
 * Date: 17.02.17
 * Time: 01:05
 */
class TransactionAmountWasChangedEvent extends TransactionEvent
{
    private $amount;
    private $newAmount;

    public function __construct(
        string $transactionId,
        int $userId,
        int $amount,
        int $newAmount
    )
    {
        parent::__construct($transactionId, $userId);

        $this->amount = $amount;
        $this->newAmount = $newAmount;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @return int
     */
    public function getNewAmount(): int
    {
        return $this->newAmount;
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
            $data['newAmount']
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
            'newAmount' => $this->newAmount
        ];
    }
}