<?php


namespace App\Repositories;


use App\Contracts\UserContract;
use App\Models\User;

class UserRepository extends BaseRepositories implements UserContract
{

    /**
     * @param User $model
     * @param array $filters
     */
    public function __construct(User $model, array $filters = [])
    {
        parent::__construct($model, $filters);
    }

    public function new(array $data)
    {
        $data['password'] = bcrypt($data['password']);
        return $this->model::create($data);
    }

    public function update($id, array $data)
    {
        $user = $this->findOneById($id);

        if (array_key_exists('password',$data))
        {
            $data['password'] = bcrypt($data['password']);
        }

        $user->update($data);

        return $user;
    }

    public function destroy($id)
    {
        $user = $this->findOneById($id);

        return $user->delete();
    }
}
