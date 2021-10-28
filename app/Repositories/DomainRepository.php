<?php


namespace App\Repositories;


use App\Contracts\DomainContract;
use App\Models\Domain;

class DomainRepository extends BaseRepositories implements DomainContract
{

    /**
     * @param Domain $model
     * @param array $filters
     */
    public function __construct(Domain $model, array $filters = [
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
        $domain = $this->findOneById($id);

        $domain->update($data);

        return $domain;
    }

    public function destroy($id)
    {
        $domain = $this->findOneById($id);

        return $domain->delete();
    }
}
