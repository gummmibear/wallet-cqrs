<?php

namespace Domain\Wallet;

use Broadway\EventSourcing\EventSourcedAggregateRoot;
use Domain\Wallet\Event\TransactionAmountWasChangedEvent;
use Domain\Wallet\Event\TransactionDateWasChangedEvent;
use Domain\Wallet\Event\TransactionTitleWasChangedEvent;
use Domain\Wallet\Event\TransactionWasAddedEvent;

class Transaction extends EventSourcedAggregateRoot
{
    public $transactionId;
    public $userId;
    public $amount;
    public $type;
    public $title;
    public $dateTime;

    public static function create(
        string $transactionId,
        int $userId,
        int $amount,
        int $type,
        string $title,
        \DateTime $dateTime)
    {
        $transaction = new self();
        $transaction->apply(new TransactionWasAddedEvent(
            $transactionId,
            $userId,
            $amount,
            $type,
            $title,
            $dateTime
        ));

        return $transaction;
    }

    /**
     * @return string
     */
    public function getAggregateRootId()
    {
        return $this->transactionId;
    }

    public function applyTransactionWasAddedEvent(TransactionWasAddedEvent $transactionWasAddedEvent)
    {
        $this->transactionId = $transactionWasAddedEvent->getTransactionId();
        $this->userId = $transactionWasAddedEvent->getUserId();
        $this->amount = $transactionWasAddedEvent->getAmount();
        $this->type = $transactionWasAddedEvent->getType();
        $this->title = $transactionWasAddedEvent->getTitle();
        $this->dateTime = $transactionWasAddedEvent->getDateTime();
    }

    public function applyTransactionTitleWasChangedEvent(
        TransactionTitleWasChangedEvent $transactionTitleWasChanged
    ){
        $this->transactionId = $transactionTitleWasChanged->getTransactionId();
        $this->userId = $transactionTitleWasChanged->getUserId();
        $this->title = $transactionTitleWasChanged->getTitle();
    }

    public function applyTransactionDateWasChangedEvent(
        TransactionDateWasChangedEvent $transactionDateWasChangedEvent
    ) {
        $this->transactionId = $transactionDateWasChangedEvent->getTransactionId();
        $this->userId = $transactionDateWasChangedEvent->getUserId();
        $this->dateTime = $transactionDateWasChangedEvent->getDateTime();
    }

    public function applyTransactionAmountWasChangedEvent(
        TransactionAmountWasChangedEvent $transactionAmountWasChangedEvent
    ) {
        $this->transactionId = $transactionAmountWasChangedEvent->getTransactionId();
        $this->userId = $transactionAmountWasChangedEvent->getUserId();
        $this->amount = $transactionAmountWasChangedEvent->getNewAmount();
    }
}