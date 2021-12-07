<?php

namespace App\Http\Controllers\Api\Company;

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

    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return StoryResource::collection($this->story->findBy(['company_id' => auth('company')->id()]));
    }

    public function show($id)
    {
        $story = $this->story->findOneBy(['company_id' => auth('company')->id(),'id' => $id]);
        return new StoryResource($story);
    }

    public function store(Request $request)
    {
        if (auth('company')->story_state === 2)
        {
            return response()->json([
                'success' => false,
                'message' => 'This functionality is disabled for this company, please contact administration for more information.',
            ],403);
        }
        $data = $request->validate(['image' => 'required|file|image|max:10000']);
        $data['company_id'] =  auth('company')->id();

        $story = $this->story->new($data);

        return response()->json([
            'success' => true,
            'story' => new StoryResource($story),
        ]);

    }

    public function update($id,Request $request)
    {
        $data = $request->validate(['image' => 'required|file|image|max:10000']);
        $data['company_id'] =  auth('company')->id();

        $story = $this->story->update($id,$data);

        return response()->json([
            'success' => true,
            'story' => new StoryResource($story),
        ]);
    }

    public function destroy($id)
    {
        $this->story->destroy($id);

        return response()->json([
            'success' => true,
            'message' => __('messages.delete'),
        ]);
    }
}
