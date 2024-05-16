<?php

namespace App\Controllers\Loan;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;

class ShowController extends BaseController
{
    public function __invoke(Request $request, Response $response, string $id)
    {
        $data = $this->repository->getById((int) $id);
        if ($data === false) {
            return $response->withStatus(404);
        }
        $dataJson = json_encode($data);
        $response->getBody()->write($dataJson);
        return $response;
    }
}