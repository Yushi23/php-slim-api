<?php

namespace App\Controllers\Loan;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UpdateController extends BaseController
{
    public function __invoke(Request $request, Response $response, string $id)
    {
        $dataFromBody = $request->getParsedBody();
        $dataById = $this->repository->getById($id);
        if ($dataById === false) {
            return $response->withStatus(404);
        }
        $this->repository->update($dataFromBody, $id);
        return $response->withStatus(204);
    }
}