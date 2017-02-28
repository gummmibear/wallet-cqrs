<?php

namespace Domain\Wallet\Commands;

use Domain\Wallet\Event\MoneyWasAddedEvent;
use Domain\Wallet\Event\MoneyWasSubtractedEvent;
use Domain\Wallet\Transaction;
use Domain\Wallet\Wallet;

class MoneyCommandHandler extends AbstractMoneyCommandHandler
{
    public function handleAddMoneyCommand(AddMoneyCommand $command)
    {
        try {
            $wallet = $this->repository->load($command->getUserId());
            $wallet->apply(new MoneyWasAddedEvent(
                $command->getTransactionId(),
                $command->getUserId(),
                $command->getAmount(),
                $command->getTitle(),
                new \DateTime()
            ));

            $this->repository->save($wallet);
            $this->createTransaction($command);
        } catch (\Exception $ex) {
            $wallet = Wallet::create(
                $command->getTransactionId(),
                $command->getUserId(),
                $command->getAmount(),
                $command->getTitle()
            );

            $this->repository->save($wallet);
            $this->createTransaction($command);
        }
    }

    public function handleSubMoneyCommand(SubMoneyCommand $command)
    {
        $wallet = $this->repository->load($command->getUserId());
        $wallet->apply(new MoneyWasSubtractedEvent(
            $command->getTransactionId(),
            $command->getUserId(),
            $command->getAmount(),
            $command->getTitle(),
            new \DateTime()
        ));

        $this->repository->save($wallet);
        $this->createTransaction($command);
    }

    public function createTransaction(MoneyCommand $command)
    {
        $type = 1;
        if ($command instanceof SubMoneyCommand) {
            $type = -1;
        }
        $transaction = Transaction::create(
            $command->getTransactionId(),
            $command->getUserId(),
            $command->getAmount(),
            $type,
            $command->getTitle(),
            new \DateTime()
        );

        $this->transactionRepository->save($transaction);
    }
}