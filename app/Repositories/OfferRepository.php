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
    public function __construct(Offer $model, array $filters = [])
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
        return $offer;
    }

    public function update($id, array $data)
    {
        $offer = $this->findOneById($id);

        $offer->update($data);

        return $offer;
    }

    public function destroy($id)
    {
        $offer = $this->findOneById($id);

        return $offer->delete();
    }
}
