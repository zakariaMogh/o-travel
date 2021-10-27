<?php


namespace App\Repositories;


use App\Contracts\OfferContract;
use App\Models\Offer;

class OfferRepository extends BaseRepositories implements OfferContract
{

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
        return $this->model::create($data);
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
