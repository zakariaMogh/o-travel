<?php


namespace App\Repositories;


use App\Contracts\UserContract;
use App\Models\Offer;
use App\Models\User;
use App\Traits\UploadAble;

class UserRepository extends BaseRepositories implements UserContract
{
    use UploadAble;
    /**
     * @param User $model
     * @param array $filters
     */
    public function __construct(User $model, array $filters = [
        \App\QueryFilter\Search::class,
        \App\QueryFilter\State::class
    ])
    {
        parent::__construct($model, $filters);
    }

    public function new(array $data)
    {
        if (array_key_exists('image', $data))
        {
            $data['image'] = $this->uploadOne($data['image'],'user/img');
        }

        if (array_key_exists('image_url', $data))
        {
            $data['image'] = $data['image_url'];
        }

        $data['password'] = bcrypt($data['password']);
        return $this->model::create($data);
    }

    public function update($id, array $data)
    {
        $user = $this->findOneById($id);

        if (array_key_exists('image', $data))
        {
            if ($user->image)
            {
                $this->deleteOne($user->image);
            }
            $data['image'] = $this->uploadOne($data['image'],'user/img');
        }

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

        if ($user->image)
        {
            $this->deleteOne($user->image);
        }

        return $user->delete();
    }

    public function makeReport($id, array $data)
    {
        $user = $this->findOneById($id);
        return $user->reports()->create($data);
    }

    public function favoriteToggle($user, $offer)
    {
        $user = $this->findOneById($user);
        $offer = Offer::findOrFail($offer);
        $user->favorites()->toggle($offer->id);

        return $offer->loadCount(['authUser']);
    }
}
