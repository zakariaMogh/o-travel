<?php

namespace App\Http\Controllers\Api\Company;

use App\Contracts\CompanyContract;
use App\Contracts\OfferContract;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\OfferRequest;
use App\Http\Resources\OfferResource;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $this->offer->setRelations(['images','category','company','countries']);
        if ($request->input('mine') === 2)
        {
            $this->offer->setScopes(['authCompany']);
        }
        $offers = $this->offer->setCounts(['authCompany'])->findByFilter();
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
        $data['published_at'] = $data['published_at'] ? $data['published_at'] : Carbon::now();
        $data['company_id'] = company()->id;
        $data['state'] = company()->auto_accepted === 2 ? 2 : 1;
        if( company()->offers_count >= company()->max_number_of_offers)
        {
            abort(403,'You have reached your offers limit');
        }

        $offer = $this->offer->new($data);

        return $this->respondCreated(__('messages.create'),new OfferResource($offer->load(['images','category','company','countries'])));
    }

    /**
     * Display the specified resource.
     *
     * @param    $id
     * @param Request $request
     * @return OfferResource
     */
    public function show($id,Request $request): OfferResource
    {
        $this->offer->setRelations(['images','category','company','countries']);
        if ($request->input('mine') === 2)
        {
            $this->offer->setScopes(['authCompany']);
        }
        $offer = $this->offer->setCounts(['authCompany'])->findOneById($id);

        return new OfferResource($offer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param OfferRequest $request
     * @param  $id
     * @return JsonResponse
     */
    public function update(OfferRequest $request, $id): JsonResponse
    {
        $data = $request->validated();

        $offer = $this->offer->setScopes(['authCompany'])->update($id,$data);

        return $this->respondUpdated(__('messages.update'),new OfferResource($offer->loadCount('authCompany')->load(['images','category','company','countries'])));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $this->offer->setScopes(['authCompany'])->destroy($id);

        return $this->respondUpdated(__('messages.delete'));
    }

    public function markAsFavorite($id, CompanyContract $companyContract): OfferResource
    {
        $offer =  $companyContract->favoriteToggle(auth('company')->id(),$id);
        return new OfferResource($offer->load(['images','category','company','countries']));
    }
}
