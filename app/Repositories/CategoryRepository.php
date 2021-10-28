<?php


namespace App\Repositories;


use App\Contracts\CategoryContract;
use App\Models\Category;

class CategoryRepository extends BaseRepositories implements CategoryContract
{

    /**
     * @param Category $model
     * @param array $filters
     */
    public function __construct(Category $model, array $filters = [
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
        $category = $this->findOneById($id);

        $category->update($data);

        return $category;
    }

    public function destroy($id)
    {
        $category = $this->findOneById($id);

        return $category->delete();
    }
}
