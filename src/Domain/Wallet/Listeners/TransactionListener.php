<?php

namespace Domain\Wallet\Listeners;

use Broadway\Processor\Processor;
use Broadway\ReadModel\RepositoryInterface;
use Domain\Wallet\Event\TransactionAmountWasChangedEvent;
use Domain\Wallet\Event\TransactionDateWasChangedEvent;
use Domain\Wallet\Event\TransactionTitleWasChangedEvent;
use Domain\Wallet\Event\TransactionWasAddedEvent;
use Domain\Wallet\ReadModel\Transaction;

class TransactionListener extends Processor
{
    private $repository;

    public function __construct(
        RepositoryInterface $repository
    ) {

        $this->repository = $repository;
    }

    public function handleTransactionWasAddedEvent(
        TransactionWasAddedEvent $transactionWasAddedEvent
    ) {

        $transaction = new Transaction(
            $transactionWasAddedEvent->getTransactionId(),
            $transactionWasAddedEvent->getUserId(),
            $transactionWasAddedEvent->getAmount(),
            $transactionWasAddedEvent->getType(),
            $transactionWasAddedEvent->getTitle(),
            $transactionWasAddedEvent->getDateTime()
        );

        $this->repository->save($transaction);
    }

    public function handleTransactionTitleWasChangedEvent(
        TransactionTitleWasChangedEvent $transactionTitleWasChangedEvent
    ) {

        /** @var Transaction $transaction */
        $transaction = $this->repository->find($transactionTitleWasChangedEvent->getTransactionId());

        if (!$transaction) {
            return;
        }

        $transaction->setTitle($transactionTitleWasChangedEvent->getTitle());

        $this->repository->save($transaction);
    }

    public function handleTransactionDateWasChangedEvent(
        TransactionDateWasChangedEvent $transactionDateWasChangedEvent
    ) {

        /** @var Transaction $transaction */
        $transaction = $this->repository->find($transactionDateWasChangedEvent->getTransactionId());

        if (!$transaction) {
            return;
        }

        $transaction->setDateTime($transactionDateWasChangedEvent->getDateTime());

        $this->repository->save($transaction);
    }

    public function handleTransactionAmountWasChangedEvent(
        TransactionAmountWasChangedEvent $transactionAmountWasChangedEvent
    ) {

        /** @var Transaction $transaction */
        $transaction = $this->repository->find($transactionAmountWasChangedEvent->getTransactionId());

        if (!$transaction) {
            return;
        }

        $transaction->setAmount($transactionAmountWasChangedEvent->getNewAmount());

        $this->repository->save($transaction);
    }
}
