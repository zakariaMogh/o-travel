<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use App\Contracts\StoryContract;
use App\Contracts\CompanyContract;
use App\Http\Controllers\Controller;
use App\Http\Resources\StoryResource;
use App\Http\Resources\CompanyResource;

class StoryController extends Controller
{
    protected $story;
    protected $company;
    public function __construct(StoryContract $story, CompanyContract $company)
    {
        $this->story = $story;
        $this->company = $company;
    }

    /**
     * Handle the incoming request.
     *
     */
    public function index(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return StoryResource::collection($this->story->setRelations(['company'])->setScopes(['active', 'visible'])->findByFilter());
    }

    /**
     * Handle the incoming request.
     *
     */
    public function getStoriesByCompany(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $companies = $this->company->setRelations(['stories' => function($q)
        {
            $q->scopes(['active', 'visible']);
        }])->setScopes(['hasActiveStories'])->findByFilter();
        return CompanyResource::collection($companies);
    }
}
