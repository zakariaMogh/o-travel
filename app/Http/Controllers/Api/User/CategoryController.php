<?php

namespace App\Http\Controllers\Api\User;

use App\Contracts\CategoryContract;
use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryController extends ApiController
{
    /**
     * @var CategoryContract
     */
    protected $category;

    /**
     * @param CategoryContract $category
     */
    public function __construct(CategoryContract $category)
    {
        $this->category = $category;
    }

    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function __invoke(Request $request): AnonymousResourceCollection
    {
        $categories = $this->category->setPerPage(0)->findByFilter();
        return CategoryResource::collection($categories);
    }

}
