<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\NotificationResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class NotificationController extends ApiController
{

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        user()->unreadNotifications()->update(['read_at' => now()]);
        return NotificationResource::collection(user()->notifications()->latest()->paginate(20));
    }

    public function destroy($id)
    {
        $notification = user()->notifications()->findOrFail($id);
        $notification->delete();
        return response()->json([
            'success' => true,
            'message' => __('messages.delete'),
        ]);
    }

    public function count()
    {
        $count = user()->notifications()->whereNull('read_at')->count();
        return response()->json([
            'count' => $count,
        ]);
    }

}
