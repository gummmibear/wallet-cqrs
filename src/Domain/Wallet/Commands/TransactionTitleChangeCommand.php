<?php

namespace Domain\Wallet\Commands;

class TransactionTitleChangeCommand extends TransactionCommand
{
    private $title;

    public function __construct(string $transactionId, int $userId, string $title)
    {
        parent::__construct($transactionId, $userId);
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }
}
