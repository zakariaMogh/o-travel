<?php

namespace App\Http\Controllers\Api\Company;

use App\Contracts\CompanyContract;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReportController extends Controller
{
    protected $company;
    public function __construct(CompanyContract $company)
    {
        $this->company = $company;
    }

    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        return \response()->json([
            'message' => 'hi',
        ]);
        /*$data = $request->validate([
            'subject' => 'required|string|max:200',
            'message' => 'required|string|max:200',
            'email'   => 'required|string|email|max:200',
        ]);
        $this->company->makeReport(auth('company')->id(),$data);

        return \response()->json([
            'success' => true,
            'message' => __('messages.create'),
        ]);*/
    }
}
