<?php

namespace App\DataProvider;

use Domain\Wallet\Helper\MoneyHelper;
use Domain\Wallet\ReadModel\Transaction;
use Domain\Wallet\ReadModel\TransactionRepository;

class TransactionDataProvider
{
    /** @var TransactionRepository */
    private $transactionRepository;

    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    /**
     * @param string $userId
     * @return \Broadway\ReadModel\ReadModelInterface[]
     */
    public function getByUserId(string $userId)
    {
        return $this->transactionRepository->findBy(['userId'=>$userId]);
    }

    public function getStats(string $userId)
    {
        $income = $this->transactionRepository
            ->getUserTransactionStatsByUserIdAndTransactionType($userId, Transaction::INCOME_TYPE);
        $outcome = $this->transactionRepository
            ->getUserTransactionStatsByUserIdAndTransactionType($userId, Transaction::OUTCOME_TYPE);

        return [
            'income' => MoneyHelper::formatMoney($income),
            'outcome' => MoneyHelper::formatMoney($outcome),
        ];
    }
}
