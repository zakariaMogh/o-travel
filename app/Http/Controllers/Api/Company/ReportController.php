<?php

namespace App\Http\Controllers\Api\Company;

use App\Contracts\UserContract;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReportController extends Controller
{
    protected $user;
    public function __construct(UserContract $user)
    {
        $this->user = $user;
    }

    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $data = $request->validate([
            'subject' => 'required|string|max:200',
            'message' => 'required|string|max:200',
            'email'   => 'required|string|email|max:200',
        ]);
        $this->user->makeReport(auth('user')->id(),$data);
        /*return \response()->json([
            'success' => true,
            'message' => __('messages.create'),
        ]);*/
        return response()->json([
            'success' => true,
            'message' => 'this is the message',
        ]);
    }
}
