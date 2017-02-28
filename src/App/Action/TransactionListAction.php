<?php

namespace App\Action;

use App\DataProvider\TransactionDataProvider;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;

class TransactionListAction
{
    private $transactionDataProvider;

    public function __construct(TransactionDataProvider $transactionDataProvider)
    {
        $this->transactionDataProvider = $transactionDataProvider;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $transaction = $this
            ->transactionDataProvider
            ->getByUserId(22);

        return new JsonResponse($transaction);
    }
}