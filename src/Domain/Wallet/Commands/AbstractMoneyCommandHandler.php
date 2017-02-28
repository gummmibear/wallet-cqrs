<?php

namespace Domain\Wallet\Commands;


use Broadway\CommandHandling\CommandHandler;
use Broadway\EventSourcing\EventSourcingRepository;

abstract class AbstractMoneyCommandHandler extends CommandHandler
{
    protected $repository;
    protected $transactionRepository;

    public function __construct(
        EventSourcingRepository $repository,
        EventSourcingRepository $transactionRepository
    ){
        $this->repository = $repository;
        $this->transactionRepository = $transactionRepository;
    }
}