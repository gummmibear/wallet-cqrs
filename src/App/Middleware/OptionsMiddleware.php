<?php

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response;

class OptionsMiddleware
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        if ($request->getMethod() == 'OPTIONS') {
            return new Response();
        }

        return $next($request, $response);
    }
}
