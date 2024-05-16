<?php

namespace App\Controllers\Loan;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class CreateController extends BaseController
{
    public function __invoke(Request $request, Response $response)
    {
        $dataFromBody = $request->getParsedBody();
        $this->repository->create($dataFromBody);
        return $response->withStatus(201);
    }
}