<?php

namespace App\Http\Controllers\Api\Company;

use App\Contracts\CityContract;
use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\CityResource;
use Illuminate\Http\Request;

class CityController extends ApiController
{
    protected $city;
    public function __construct(CityContract $city)
    {
        $this->city = $city;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $cities = $this->city->findByFilter();

        return CityResource::collection($cities);

    }
}
