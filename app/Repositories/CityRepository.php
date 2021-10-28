<?php


namespace App\Repositories;


use App\Contracts\CityContract;
use App\Models\City;

class CityRepository extends BaseRepositories implements CityContract
{

    /**
     * @param City $model
     * @param array $filters
     */
    public function __construct(City $model, array $filters = [
        \App\QueryFilter\Search::class,
    ])
    {
        parent::__construct($model, $filters);
    }

    public function new(array $data)
    {
        return $this->model::create($data);
    }

    public function update($id, array $data)
    {
        $city = $this->findOneById($id);

        $city->update($data);

        return $city;
    }

    public function destroy($id)
    {
        $city = $this->findOneById($id);

        return $city->delete();
    }
}
