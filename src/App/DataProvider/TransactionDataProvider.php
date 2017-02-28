<?php

namespace App\DataProvider;

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
}