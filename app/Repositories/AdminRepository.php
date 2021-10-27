<?php


namespace App\Repositories;


use App\Contracts\AdminContract;
use App\Models\Admin;
use App\Traits\UploadAble;

class AdminRepository extends BaseRepositories implements AdminContract
{
    use UploadAble;

    /**
     * @param Admin $model
     * @param int $per_page
     * @param array $filters
     */
    public function __construct(Admin $model, $per_page = 10, array $filters = [])
    {
        parent::__construct($model, $filters);
    }

    public function new(array $data)
    {
        if (array_key_exists('pic', $data))
        {
            $data['pic'] = $this->uploadOne($data['pic'],'admin/img');
        }
        $data['password'] = bcrypt($data['password']);
        $admin = $this->model::create($data);
        $admin->assignRole($data['roles']);
        return $admin;
    }

    public function update($id, array $data)
    {
        $admin = $this->findOneById($id);
        if (array_key_exists('pic', $data))
        {
            if ($admin->pic)
            {
                $this->deleteOne($admin->pic);
            }
            $data['pic'] = $this->uploadOne($data['pic'],'admin/img');
        }

        if (array_key_exists('password',$data))
        {
            $data['password'] = bcrypt($data['password']);
        }

        $admin->update($data);

        if (array_key_exists('roles',$data))
        {
            $admin->syncRoles($data['roles']);
        }

        return $admin;
    }

    public function destroy($id)
    {
        $admin = $this->findOneById($id);
        if ($admin->pic)
        {
            $this->deleteOne($admin->pic);
        }
        return $admin->delete();
    }
}
