<?php

namespace App\Http\Controllers\Api\User;

use App\Contracts\UserContract;
use App\Contracts\OfferContract;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\OfferRequest;
use App\Http\Resources\OfferResource;
use App\Models\Image;
use App\Traits\UploadAble;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class OfferController extends ApiController
{

    use UploadAble;

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
    public function index(Request $request): AnonymousResourceCollection
    {
        $offers = $this->offer->setRelations(['images','category','company','countries'])->setCounts(['authUser'])->findByFilter();

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
        return new OfferResource($offer->load(['images','category','company','countries']));
    }

}
