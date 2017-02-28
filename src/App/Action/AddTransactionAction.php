<?php

namespace App\Action;

use Domain\Wallet\Commands\AddMoneyCommand;
use Domain\Wallet\Commands\SubMoneyCommand;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;

class AddTransactionAction extends AbstractAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $json = $request->getAttribute('json');
        $userId = $request->getAttribute('userId');

        if ((int)$json->type == 1) {
            $command = new AddMoneyCommand(
                uniqid(),
                $userId,
                $json->amount * 100,
                $json->title
            );
            $this->commandBus->dispatch($command);
        }

        if ((int)$json->type == -1) {
            $command = new SubMoneyCommand(
                uniqid(),
                $userId,
                $json->amount * 100,
                $json->title
            );

            $this->commandBus->dispatch($command);
        }

        return new JsonResponse([
            self::COMMAND => [
                self::TRANSACTION_ID => $command->getTransactionId(),
                self::AMOUNT => $command->getAmount(),
                self::TITLE => $command->getTitle()
            ]
        ]);
    }
}
