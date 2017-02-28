<?php
/**
 * Created by PhpStorm.
 * User: gbear
 * Date: 17.02.17
 * Time: 01:55
 */

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
        $this->transactionCount++;
    }

    public function applyMoneyWasSubtractedEvent(MoneyWasSubtractedEvent $event)
    {
        $this->userId = $event->getUserId();
        $this->accountBalance -= $event->getAmount();
        $this->transactionCount++;
    }

    public function applyTransactionAmountWasChangedEvent(TransactionAmountWasChangedEvent $event)
    {
        $this->userId = $event->getUserId();
        $diff = ($event->getAmount() - $event->getNewAmount());
        $this->accountBalance += ($diff*-1);
    }
}

/**    public function registerEvent(MoneyEvent $event)
    {
        $this->events[] = $event;
    }
    public function getAccuntBalance()
    {
        $this->accountBalance = 0;

        foreach ($this->events as $event) {
            ///moooove to handlers !!
            switch (get_class($event)) {
                case MoneyWasAdded::class:
                    $this->accountBalance+=$event->getAmount();
                    break;

                case MoneyWasSubtracted::class:
                    $this->accountBalance-=$event->getAmount();
                    break;
            }
        }
    }
*/