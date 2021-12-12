<?php


namespace App\Repositories;


use App\Contracts\CountryContract;
use App\Models\Country;

class CountryRepository extends BaseRepositories implements CountryContract
{

    /**
     * @param Country $model
     * @param array $filters
     */
    public function __construct(Country $model, array $filters = [
        \App\QueryFilter\Search::class,

    ])
    {
        parent::__construct($model, $filters);
    }

    public function new(array $data)
    {
        $country =  $this->model::create($data);
        if (array_key_exists('categories',$data))
        {
            $country->categories()->attach($data['categories']);
        }
        return $country;
    }

    public function update($id, array $data)
    {
        $country = $this->findOneById($id);

        $country->update($data);

        if (array_key_exists('categories',$data))
        {
            $country->categories()->sync($data['categories']);
        }

        return $country;
    }

    public function destroy($id)
    {
        $country = $this->findOneById($id);

        return $country->delete();
    }
}
