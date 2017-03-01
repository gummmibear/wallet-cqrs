<?php

namespace Domain\Wallet\Listeners;

use Broadway\Processor\Processor;
use Broadway\ReadModel\RepositoryInterface;
use Domain\Wallet\Event\MoneyWasAddedEvent;
use Domain\Wallet\Event\MoneyWasSubtractedEvent;
use Domain\Wallet\Event\TransactionAmountWasChangedEvent;
use Domain\Wallet\ReadModel\Wallet;

class WalletListener extends Processor
{
    private $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function handleMoneyWasAddedEvent(MoneyWasAddedEvent $event)
    {
        $wallet = $this->repository->find($event->getUserId());
        /** @var Wallet $wallet */
        if (!$wallet) {
            $wallet = new Wallet($event->getUserId(), 0, 0);
        }

        $wallet->setAccountBalance(
            $wallet->getAccountBalance() + $event->getAmount()
        );
        $wallet->incrementTransactionCount();

        $this->repository->save($wallet);
    }

    public function handleMoneyWasSubtractedEvent(MoneyWasSubtractedEvent $event)
    {
        /** @var Wallet $wallet */
        $wallet = $this->repository->find($event->getUserId());

        $wallet->setAccountBalance(
            $wallet->getAccountBalance() - $event->getAmount()
        );
        $wallet->incrementTransactionCount();

        $this->repository->save($wallet);
    }

    public function handleTransactionAmountWasChangedEvent(TransactionAmountWasChangedEvent $event)
    {
        /** @var Wallet $wallet */
        $wallet = $this->repository->find($event->getUserId());
        $accountBalance = $wallet->getAccountBalance();

        $amount = $event->getAmount();
        $newAmount = $event->getNewAmount();

        $diff = ($amount - $newAmount) * ($event->getTransactionType() * -1);
        $newAccountBalance = $accountBalance + $diff;

        $wallet->setAccountBalance($newAccountBalance);

        $this->repository->save($wallet);
    }
}
