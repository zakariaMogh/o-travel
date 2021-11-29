<?php

namespace App\Http\Controllers\Api\User;

use App\Contracts\CompanyContract;
use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyResource;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    protected $company;

    public function __construct(CompanyContract $company)
    {
        $this->company = $company;
    }

    public function index()
    {
        $companies = $this->setPerPage(12)->company->findByFilter();

        return CompanyResource::collection($companies);
    }

    public function show($id)
    {
        $company = $this->company->findOneById($id);

        return new CompanyResource($company);
    }
}
