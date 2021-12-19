<?php

namespace App\Repositories;

use App\Models\Story;
use App\Traits\UploadAble;
use Illuminate\Database\Eloquent\Model;

class StoryRepository extends BaseRepositories implements \App\Contracts\StoryContract
{
    use UploadAble;
    public function __construct(Story $model, array $filters = [])
    {
        parent::__construct($model, $filters);
    }

    /**
     * @inheritDoc
     */
    public function new(array $data)
    {
        if (array_key_exists('image',$data))
        {
            $data['image'] = $this->uploadOne($data['image'],'stories/img');
        }

        return $this->model::create($data);
    }

    /**
     * @inheritDoc
     */
    public function update($id, array $data)
    {
        $story = $this->findOneById($id);
        if (array_key_exists('image',$data))
        {
            if ($story->image)
            {
                $this->deleteOne($story->image);
            }

            $data['image'] = $this->uploadOne($data['image'],'stories/img');
        }
        $story->update($data);
        return $story;
    }

    /**
     * @inheritDoc
     */
    public function destroy($id)
    {
        $story = $this->findOneById($id);

        if ($story->image)
        {
            $this->deleteOne($story->image);
        }

        return $story->delete($id);
    }


    public function toggle($id)
    {
        $story = $this->findOneById($id);
        $story->update([
            'state' => ($story->state == 1 ? 2 : 1)
        ]);
        return $story;
    }
}
