<?php


namespace App\Repositories;


use App\Contracts\ImageContract;
use App\Models\Image;

class ImageRepository extends BaseRepositories implements ImageContract
{

    /**
     * @param Image $model
     * @param array $filters
     */
    public function __construct(Image $model, array $filters = [])
    {
        parent::__construct($model, $filters);
    }

    public function new(array $data)
    {
        return $this->model::create($data);
    }

    public function update($id, array $data)
    {
        $image = $this->findOneById($id);

        $image->update($data);

        return $image;
    }

    public function destroy($id)
    {
        $image = $this->findOneById($id);

        return $image->delete();
    }
}
