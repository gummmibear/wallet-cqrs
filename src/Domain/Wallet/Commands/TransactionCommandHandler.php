<?php
/**
 * Created by PhpStorm.
 * User: gbear
 * Date: 25.02.17
 * Time: 18:26
 */

namespace Domain\Wallet\Commands;


use Domain\Wallet\Event\TransactionAmountWasChangedEvent;
use Domain\Wallet\Event\TransactionDateWasChangedEvent;
use Domain\Wallet\Event\TransactionTitleWasChangedEvent;
use Domain\Wallet\Transaction;
use Domain\Wallet\Wallet;

class TransactionCommandHandler extends AbstractMoneyCommandHandler
{
    public function handleTransactionTitleChangeCommand(
        TransactionTitleChangeCommand $transactionTitleChangeCommand
    )
    {
            /** @var Transaction $transaction */
            $transaction = $this->transactionRepository->load($transactionTitleChangeCommand->getTransactionId());
            $transaction->apply(new TransactionTitleWasChangedEvent(
                $transactionTitleChangeCommand->getTransactionId(),
                $transactionTitleChangeCommand->getUserId(),
                $transactionTitleChangeCommand->getTitle()
            ));

            $this->transactionRepository->save($transaction);
    }

    public function handleTransactionAmountChangeCommand(
        TransactionAmountChangeCommand $transactionAmountChangeCommand
    )
    {
        /** @var Transaction $transaction */
        $transaction = $this->transactionRepository->load($transactionAmountChangeCommand->getTransactionId());

        $transactionAmountWasChangedEvent = new TransactionAmountWasChangedEvent(
            $transactionAmountChangeCommand->getTransactionId(),
            $transactionAmountChangeCommand->getUserId(),
            $transaction->amount,
            $transactionAmountChangeCommand->getAmount()
        );
        $transaction->apply($transactionAmountWasChangedEvent);
        $this->transactionRepository->save($transaction);

        /** @var Wallet $wallet */
        $wallet = $this->repository->load($transactionAmountChangeCommand->getUserId());
        $wallet->apply($transactionAmountWasChangedEvent);
        $this->repository->save($wallet);
    }

    public function handleTransactionDateChangeCommand(
        TransactionDateChangeCommand $transactionDateChangeCommand
    )
    {
        /** @var Transaction $transaction */
        $transaction = $this->transactionRepository->load($transactionDateChangeCommand->getTransactionId());
        $transaction->apply(
            new TransactionDateWasChangedEvent(
                $transactionDateChangeCommand->getTransactionId(),
                $transactionDateChangeCommand->getUserId(),
                $transactionDateChangeCommand->getDateTime()
            )
        );

        $this->transactionRepository->save($transaction);
    }
}