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
    private $type;

    public function __construct(
        string $transactionId,
        int $userId,
        int $amount,
        int $newAmount,
        int $type
    ) {

        parent::__construct($transactionId, $userId);

        $this->amount = $amount;
        $this->newAmount = $newAmount;
        $this->type = $type;
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

    public function getTransactionType(): int
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
            $data['newAmount'],
            $data['type']
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
            'newAmount' => $this->newAmount,
            'type' => $this->type
        ];
    }
}
