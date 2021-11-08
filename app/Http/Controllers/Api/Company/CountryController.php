<?php

namespace App\Http\Controllers\Api\Company;

use App\Contracts\CountryContract;
use App\Http\Controllers\Controller;
use App\Http\Resources\CountryResource;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    protected $country;
    public function __construct(CountryContract $country)
    {
        $this->country = $country;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $countries = $this->country->findByFilter();
        return CountryResource::collection($countries);

    }
}
