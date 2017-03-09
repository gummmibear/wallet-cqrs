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

        $commands = [];

        if ($json->title) {
            $commands[] = new TransactionTitleChangeCommand(
                $transactionId,
                $json->userId,
                $json->title
            );
        }

        if ($json->amount) {
            $commands[] = new TransactionAmountChangeCommand(
                $transactionId,
                $json->userId,
                $json->amount * 100
            );
        }
        if ($json->dateTime) {
            $commands[] = new TransactionDateChangeCommand(
                $transactionId,
                $json->userId,
                new \DateTime($json->dateTime)
            );
        }

        if (empty($commands)) {
            throw new \Exception('Nothing to edi');
        }

        foreach ($commands as $cmd) {
            $this->commandBus->dispatch($cmd);
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
