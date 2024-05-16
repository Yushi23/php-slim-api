<?php

namespace App\Controllers\Loan;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class DeleteController extends BaseController
{
    public function __invoke(Request $request, Response $response, string $id)
    {
        $dataById = $this->repository->getById((int) $id);
        if ($dataById === false) {
            return $response->withStatus(404);
        }
        $this->repository->delete($id);
        return $response->withStatus(204);
    }
}