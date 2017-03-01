<?php

namespace App\Action;

use App\DataProvider\TransactionDataProvider;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;

class TransactionStatsAction
{
    private $transactionDataProvider;

    public function __construct(TransactionDataProvider $transactionDataProvider)
    {
        $this->transactionDataProvider = $transactionDataProvider;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $stats = $this->transactionDataProvider->getStats($request->getAttribute('userId'));

        return new JsonResponse($stats);
    }
}
