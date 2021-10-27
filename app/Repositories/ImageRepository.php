<?php


namespace App\Repositories;


use App\Contracts\ImageContract;
use App\Models\Image;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;

class ImageRepository extends BaseRepositories implements ImageContract
{

    use UploadAble;
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
        if (array_key_exists('link',$data) && $data['link'] instanceof UploadedFile)
        {
            $data['link'] = $this->uploadOne($data['link'],'offer/images');
        }
        return $this->model::create($data);
    }

    public function update($id, array $data)
    {
        $image = $this->findOneById($id);

        if (array_key_exists('link',$data) && $data['link'] instanceof UploadedFile)
        {
            if ($image->link)
            {
                $this->deleteOne($image->link);
            }

            $data['link'] = $this->uploadOne($data['link'],'offer/images');
        }else{
            unset($data['link']);
        }

        $image->update($data);

        return $image;
    }

    public function destroy($id)
    {
        $image = $this->findOneById($id);

        if ($image->link)
        {
            $this->deleteOne($image->link);
        }

        return $image->delete();
    }
}
