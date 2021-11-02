<?php

namespace App\Http\Controllers\Api\Company;

use App\Contracts\DomainContract;
use App\Http\Controllers\Controller;
use App\Http\Resources\DomainResource;
use Illuminate\Http\Request;

class DomainController extends Controller
{
    protected $domain;
    public function __construct(DomainContract $domain)
    {
        $this->domain = $domain;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request): \Illuminate\Http\JsonResponse
    {
        $domains = $this->domain->findByFilter();

        return response()->json([
            'success' => true,
            'data' => DomainResource::collection($domains),
        ]);
    }
}
