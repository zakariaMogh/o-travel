<?php

namespace App\Http\Controllers\Api\Company;

use App\Contracts\CountryContract;
use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\CountryResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CountryController extends ApiController
{
    /**
     * @var CountryContract
     */
    protected $country;

    /**
     * @param CountryContract $country
     */
    public function __construct(CountryContract $country)
    {
        $this->country = $country;
    }

    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function __invoke(Request $request): AnonymousResourceCollection
    {
        $countries = $this->country->setPerPage(0)->findByFilter();
        return CountryResource::collection($countries);

    }
}
