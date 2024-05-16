<?php

namespace App\Middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class AddJsonResponseHeader
{
    public function __invoke(Request $request, RequestHandler $handler)
    {
        $response = $handler->handle($request);
        return $response->withHeader('Content-Type', 'application/json');
    }
}