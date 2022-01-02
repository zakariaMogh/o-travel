<?php

namespace App\Http\Controllers\Api\User;

use App\Contracts\CityContract;
use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\CityResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CityController extends ApiController
{
    /**
     * @var CityContract
     */
    protected $city;

    /**
     * @param CityContract $city
     */
    public function __construct(CityContract $city)
    {
        $this->city = $city;
    }

    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function __invoke(Request $request): AnonymousResourceCollection
    {
        $cities = $this->city->setPerPage(0)->findByFilter();

        return CityResource::collection($cities);

    }
}
