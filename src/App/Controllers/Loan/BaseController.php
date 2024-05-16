<?php

namespace App\Controllers\Loan;

use App\Repositories\LoanRepository;

class BaseController
{
    public function __construct(protected LoanRepository $repository)
    {
    }
}