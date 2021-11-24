<?php

namespace App\Http\Controllers\Api\Company;

use App\Contracts\OfferContract;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\OfferRequest;
use App\Http\Resources\OfferResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class OfferController extends ApiController
{

    /**
     * @var OfferContract
     */
    protected $offer;

    /**
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
        $offers = $this->offer->setRelations(['images','category'])->setScopes(['authCompany'])->findByFilter();
        return OfferResource::collection($offers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param OfferRequest $request
     * @return JsonResponse
     */
    public function store(OfferRequest $request): JsonResponse
    {
        $data = $request->validated();

        $data['company_id'] = company()->id;
        $data['state'] = company()->auto_accepted === 2 ? 2 : 1;
        if( company()->offers_count >= company()->max_number_of_offers)
        {
            abort(403,'You have reached your offers limit');
        }

        $offer = $this->offer->new($data);

        return $this->respondCreated(__('messages.create'),new OfferResource($offer));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return OfferResource
     */
    public function show($id): OfferResource
    {
        $offer = $this->offer->setRelations(['images','category'])->setScopes(['authCompany'])->findOneById($id);
        return new OfferResource($offer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param OfferRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(OfferRequest $request, $id): JsonResponse
    {
        $data = $request->validated();

        $offer = $this->offer->setScopes(['authCompany'])->update($id,$data);

        return $this->respondUpdated(__('messages.update'),new OfferResource($offer->load(['category','images'])));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $this->offer->setScopes(['authCompany'])->destroy($id);

        return $this->respondUpdated(__('messages.delete'));
    }
}