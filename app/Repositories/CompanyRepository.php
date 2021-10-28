<?php


namespace App\Repositories;


use App\Contracts\CompanyContract;
use App\Models\Company;
use App\Traits\UploadAble;

class CompanyRepository extends BaseRepositories implements CompanyContract
{
    use UploadAble;
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
        if (array_key_exists('image', $data))
        {
            $data['image'] = $this->uploadOne($data['image'],'company/img');
        }

        $data['password'] = bcrypt($data['password']);
        return $this->model::create($data);
    }

    public function update($id, array $data)
    {
        $company = $this->findOneById($id);

        if (array_key_exists('image', $data))
        {
            if ($company->image)
            {
                $this->deleteOne($company->image);
            }
            $data['image'] = $this->uploadOne($data['image'],'company/img');
        }

        if (array_key_exists('trade_register', $data))
        {
            if ($company->trade_register)
            {
                $this->deleteOne($company->trade_register);
            }
            $data['trade_register'] = $this->uploadOne($data['trade_register'],'company/trade_register');
        }

        if (array_key_exists('password',$data))
        {
            $data['password'] = bcrypt($data['password']);
        }

        $company->update($data);

        return $company;
    }

    public function destroy($id)
    {
        $company = $this->findOneById($id);

        if ($company->image)
        {
            $this->deleteOne($company->image);
        }

        return $company->delete();
    }
}
