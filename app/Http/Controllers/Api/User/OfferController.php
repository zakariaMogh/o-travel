<?php

namespace App\Http\Controllers\Api\User;

use App\Contracts\OfferContract;
use App\Contracts\UserContract;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Resources\OfferResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class OfferController extends ApiController
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
        $offers = $this->offer->setScopes(['published'])->setRelations(['images','company'])->setCounts(['authUser'])->findByFilter();

        return OfferResource::collection($offers);
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return OfferResource
     */
    public function show($id): OfferResource
    {
        $offer = $this->offer->setScopes(['published'])->setRelations(['company','category','countries','images'])->setCounts(['authUser'])->findOneById($id);
        return new OfferResource($offer);

    }

    public function markAsFavorite($id, UserContract $user)
    {
        $offer =  $user->favoriteToggle(auth('user')->id(),$id);
        return new OfferResource($offer);
    }

}
