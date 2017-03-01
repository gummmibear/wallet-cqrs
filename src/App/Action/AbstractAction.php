<?php

namespace App\Action;

use Broadway\CommandHandling\CommandBusInterface;

abstract class AbstractAction
{
    const COMMAND = 'command';
    const TRANSACTION_ID = 'transactionId';
    const AMOUNT = 'amount';
    const TITLE = 'title';
    const DATE_TIME = 'dateTime';

    protected $commandBus;

    public function __construct(CommandBusInterface $commandBus)
    {
        $this->commandBus =  $commandBus;
    }
}
