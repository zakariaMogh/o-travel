<?php


namespace App\Repositories;


use App\Contracts\CompanyContract;
use App\Models\Company;

class CompanyRepository extends BaseRepositories implements CompanyContract
{

    /**
     * @param Company $model
     * @param array $filters
     */
    public function __construct(Company $model, array $filters = [])
    {
        parent::__construct($model, $filters);
    }

    public function new(array $data)
    {
        return $this->model::create($data);
    }

    public function update($id, array $data)
    {
        $company = $this->findOneById($id);

        $company->update($data);

        return $company;
    }

    public function destroy($id)
    {
        $company = $this->findOneById($id);

        return $company->delete();
    }
}
