<?php

namespace App\Controllers\Loan;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class IndexController extends BaseController
{
    public function __invoke(Request $request, Response $response)
    {
        $params = $request->getQueryParams();
        $sum = $params['sum'] ?? null;
        $dateCreate = $params['dateCreate'] ?? null;
        $data = $this->repository->getAll($sum, $dateCreate);
        $dataJson = empty($data) ? '' : json_encode($data);
        $response->getBody()->write($dataJson);
        return $response;
    }
}