<?php

namespace App\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use App\DataProvider\WalletDataProvider;
use Zend\Diactoros\Response\JsonResponse;

class WalletAction
{
    public function __construct(WalletDataProvider $walletDataProvider)
    {
        $this->walletDataProvider = $walletDataProvider;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $wallet = $this
            ->walletDataProvider
            ->getByUserId($request->getAttribute('userId'));

        return new JsonResponse($wallet);
    }
}
