<?php

namespace Domain\Wallet;

use Domain\Wallet\Event\MoneyWasAddedEvent;
use Domain\Wallet\Event\MoneyWasSubtractedEvent;
use Broadway\EventSourcing\EventSourcedAggregateRoot;
use Domain\Wallet\Event\TransactionAmountWasChangedEvent;

class Wallet extends EventSourcedAggregateRoot
{
    public $userId;
    public $accountBalance = 0;
    public $transactionCount = 0;

    public static function create($transactionId, $userId, $amount, $title)
    {
        $wallet = new self();
        $wallet->apply(new MoneyWasAddedEvent($transactionId, $userId, $amount, $title, new \DateTime()));

        return $wallet;
    }

    public function getAggregateRootId()
    {
        return $this->userId;
    }

    public function applyMoneyWasAddedEvent(MoneyWasAddedEvent $event)
    {
        $this->userId = $event->getUserId();
        $this->accountBalance += $event->getAmount();
        $this->transactionCount+=1;
    }

    public function applyMoneyWasSubtractedEvent(MoneyWasSubtractedEvent $event)
    {
        $this->userId = $event->getUserId();
        $this->accountBalance -= $event->getAmount();
        $this->transactionCount+=1;
    }

    public function applyTransactionAmountWasChangedEvent(TransactionAmountWasChangedEvent $event)
    {
        $this->userId = $event->getUserId();
        $accountBalance = $this->accountBalance;
        $amount = $event->getAmount();
        $newAmount = $event->getNewAmount();

        $diff = ($amount - $newAmount) * ($event->getTransactionType() * -1);
        $newAccountBalance = $accountBalance + $diff;

        $this->accountBalance = $newAccountBalance;
    }
}
