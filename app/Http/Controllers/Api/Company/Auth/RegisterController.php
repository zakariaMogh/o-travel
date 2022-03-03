<?php

namespace App\Http\Controllers\Api\Company\Auth;

use App\Contracts\CompanyContract;
use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyResource;
use Illuminate\Http\Request;
use Kreait\Laravel\Firebase\Facades\Firebase;

class RegisterController extends Controller
{
    protected $company;
    public function __construct(CompanyContract $company)
    {
        $this->company = $company;
    }

    public function register(Request $request)
    {
        $data = $this->getValidatedData($request);
        $data['auto_accepted'] = settings('auto_accept_offer_for_all');
        try {
            //$phone = $data['country_code'].$data['phone'];
            //$this->checkFirebaseUser($phone);
            $company = $this->company->new($data);

            return response()->json([
                'access_token' => $company->createToken('mobile_app_company_auth_token')->plainTextToken,
                'token_type' => 'Bearer',
                'company' => new CompanyResource($company)
            ]);
        } catch (\Kreait\Firebase\Exception\Auth\UserNotFound $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),

            ],404);
        }catch (\Exception $exception){
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
            ],500);
        }
    }

    public function getValidatedData(Request $request): array
    {
        return $request->validate([
            'name'          => 'required|string|max:200',
            'email'         => 'required|string|email|unique:companies,email',
            'password'      => 'required|string|min:8|max:24|confirmed',
            'country_code'  => 'required|regex:/^([1-9](\d{0,5}))/',
            'phone'         => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|unique:companies,phone',
            'device_token'  => 'required|string',
            'image'         => 'sometimes|nullable|file|image|max:3000',
            'city_id'       => 'required|integer|exists:cities,id',
            'domain_id'     => 'required|integer|exists:domains,id',
        ]);
    }

    private function checkFireBaseUser($phone): void
    {
        $auth = Firebase::auth();
        $auth->getUserByPhoneNumber($phone);
    }


}
