<?php


namespace App\Repositories;


use App\Contracts\AdminContract;
use App\Models\Admin;

class AdminRepository extends BaseRepositories implements AdminContract
{

    /**
     * @param Admin $model
     * @param array $filters
     */
    public function __construct(Admin $model, array $filters = [])
    {
        parent::__construct($model, $filters);
    }

    public function new(array $data)
    {
        return $this->model::create($data);
    }

    public function update($id, array $data)
    {
        $admin = $this->findOneById($id);

        $admin->update($data);

        return $admin;
    }

    public function destroy($id)
    {
        $admin = $this->findOneById($id);

        return $admin->delete();
    }
}
