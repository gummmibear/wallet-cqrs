<?php

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class JsonBodyMiddleware
{
    const JSON = 'json';
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $newRequest = $request->withAttribute('json', json_decode($request->getBody()->getContents()));

        return $next($newRequest, $response);
    }
}
