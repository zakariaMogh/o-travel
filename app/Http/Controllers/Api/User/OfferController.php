<?php

namespace App\Http\Controllers\Api\User;

use App\Contracts\OfferContract;
use App\Http\Controllers\Controller;
use App\Http\Resources\OfferResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class OfferController extends Controller
{

    /**
     * @var OfferContract
     */
    protected $offer;


    /**
     * OfferController constructor.
     * @param OfferContract $offer
     */
    public function __construct(OfferContract $offer)
    {
        $this->offer = $offer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $offers = $this->offer->setScopes(['published'])->findByFilter();

        return OfferResource::collection($offers);
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return OfferResource
     */
    public function show($id)
    {
        $offer = $this->offer->setScopes(['published'])->findOneById($id);
        return new OfferResource($offer);

    }

}
