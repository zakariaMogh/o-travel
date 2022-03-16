<?php


namespace App\Repositories;


use App\Contracts\OfferContract;
use App\Models\Image;
use App\Models\Offer;
use App\Traits\UploadAble;

class OfferRepository extends BaseRepositories implements OfferContract
{
    use UploadAble;
    /**
     * @param Offer $model
     * @param array $filters
     */
    public function __construct(Offer $model, array $filters = [
        \App\QueryFilter\Search::class,
        \App\QueryFilter\Featured::class,
        \App\QueryFilter\State::class,
        \App\QueryFilter\Category::class,
        \App\QueryFilter\Country::class,
        \App\QueryFilter\Favorite::class,
        \App\QueryFilter\Month::class,
        \App\QueryFilter\Company::class,
    ])
    {
        parent::__construct($model, $filters);
    }

    public function new(array $data)
    {
        $offer = $this->model::create($data);

        if (array_key_exists('images',$data))
        {
            foreach ($data['images'] as $image)
            {
                $offer->images()->create([
                    'link' => $this->uploadOne($image,'offers/'.$offer->id.'/images')
                ]);
            }
        }

        $offer->countries()->attach($data['countries']);
        return $offer->load(['countries','category']);
    }

    public function update($id, array $data)
    {
        $offer = $this->findOneById($id);

        $offer->update($data);
        if (array_key_exists('images',$data))
        {
            foreach ($data['images'] as $image)
            {
                $offer->images()->first()->update([
                    'link' => $image
                ]);
            }
        }

        if (array_key_exists('countries',$data))
        {
            $offer->countries()->sync($data['countries']);
        }
        return $offer;
    }


    public function destroy($id)
    {
        return $this->findOneById($id)->delete();
    }

    public function stateToggle($id, $state)
    {
        return $this->update($id, [
            'state' => $state
        ]);
    }
}
