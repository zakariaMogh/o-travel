<?php

namespace App\Http\Controllers\Api\User;

use App\Contracts\StoryContract;
use App\Http\Controllers\Controller;
use App\Http\Resources\StoryResource;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    protected $story;
    public function __construct(StoryContract $story)
    {
        $this->story = $story;
    }

    /**
     * Handle the incoming request.
     *
     */
    public function __invoke(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return StoryResource::collection($this->story->setRelations(['company'])->setScopes(['active', 'visible'])->findByFilter());
    }
}
