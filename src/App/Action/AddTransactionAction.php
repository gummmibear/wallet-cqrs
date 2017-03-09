<?php

namespace App\Action;

use Domain\Wallet\Commands\AddMoneyCommand;
use Domain\Wallet\Commands\SubMoneyCommand;
use Domain\Wallet\Helper\MoneyHelper;
use Domain\Wallet\ReadModel\Transaction;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;

class AddTransactionAction extends AbstractAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $json = $request->getAttribute('json');
        $userId = $request->getAttribute('userId');

        $moneyCommand = MoneyCommandFactory::create(
            $userId,
            (int)$json->type,
            MoneyHelper::toInt($json->amount),
            $json->title
        );

        $this->commandBus->dispatch($moneyCommand);

        return new JsonResponse([
            self::COMMAND => [
                self::TRANSACTION_ID => $moneyCommand->getTransactionId(),
                self::AMOUNT => $moneyCommand->getAmount(),
                self::TITLE => $moneyCommand->getTitle()
            ]
        ]);
    }
}
