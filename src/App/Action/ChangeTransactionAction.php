<?php

namespace App\Action;

use Domain\Wallet\Commands\TransactionAmountChangeCommand;
use Domain\Wallet\Commands\TransactionDateChangeCommand;
use Domain\Wallet\Commands\TransactionTitleChangeCommand;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;

class ChangeTransactionAction extends AbstractAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $json = $request->getAttribute('json');
        $transactionId = $request->getAttribute('transactionId');

        if ($json->title) {
            $transactionTitleChangeCommand = new TransactionTitleChangeCommand(
                $transactionId,
                $json->userId,
                $json->title
            );
            $this->commandBus->dispatch($transactionTitleChangeCommand);
        }

        if ($json->amount) {
            $transactionAmountChangeCommand = new TransactionAmountChangeCommand(
                $transactionId,
                $json->userId,
                $json->amount * 100
            );
            $this->commandBus->dispatch($transactionAmountChangeCommand);
        }
        if ($json->dateTime) {
            $transactionDateChangeCommand = new TransactionDateChangeCommand(
                $transactionId,
                $json->userId,
                new \DateTime($json->dateTime)
            );

            $this->commandBus->dispatch($transactionDateChangeCommand);
        }

        return new JsonResponse([
            self::COMMAND => [
                self::TRANSACTION_ID => $transactionId,
                self::AMOUNT => $json->amount,
                self::TITLE => $json->title,
                self::DATE_TIME => $json->dateTime
            ]
        ]);
    }
}