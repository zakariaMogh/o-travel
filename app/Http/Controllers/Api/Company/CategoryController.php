<?php

namespace App\Http\Controllers\Api\Company;

use App\Contracts\CategoryContract;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $category;
    public function __construct(CategoryContract $category)
    {
        $this->category = $category;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke(Request $request)
    {
        $categories = $this->category->findByFilter();
        return CategoryResource::collection($categories);
    }
}
