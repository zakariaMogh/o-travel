<?php

namespace App\Http\Controllers\Api\User;

use App\Contracts\DomainContract;
use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\DomainResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class DomainController extends ApiController
{
    /**
     * @var DomainContract
     */
    protected $domain;

    /**
     * @param DomainContract $domain
     */
    public function __construct(DomainContract $domain)
    {
        $this->domain = $domain;
    }

    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function __invoke(Request $request): AnonymousResourceCollection
    {
        $domains = $this->domain->findByFilter();
        return DomainResource::collection($domains);
    }
}
