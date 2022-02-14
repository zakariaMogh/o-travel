<?php

namespace App\Http\Controllers\Api\Company\Auth;

use App\Contracts\CompanyContract;
use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\UserResource;
use App\Models\Company;
use App\Traits\FirebaseAuthVerificationTrait;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Hash;
use Kreait\Firebase\Exception\Auth\UserNotFound;
use Kreait\Firebase\Exception\AuthException;
use Kreait\Firebase\Exception\FirebaseException;

class CompanyLoginController extends ApiController
{
    use FirebaseAuthVerificationTrait;
    protected $company;

    public function __construct(CompanyContract $company)
    {
        $this->company = $company;
    }

    /**
     * @return CompanyResource
     */
    public function me(): CompanyResource
    {
        $company = $this->company->setRelations(['domain', 'city'])->findOneById(auth('company')->id());
        return new CompanyResource($company);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $credentials = $this->getCredentials($request);
        return $this->loginAttemptWithPhone($credentials,$request);
    }

    private function loginAttemptWithPhone(array $credentials,Request $request): JsonResponse
    {
        try {

            //$phone = $credentials['country_code'].$credentials['phone'];
            //$this->checkFireBaseUser($request->input('uid'),$phone);
            return $this->createToken($credentials);

        } catch (UserNotFound | ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => __("auth.failed"),
            ],404);
        } catch (AuthException | FirebaseException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ],401);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ],500);
        }
    }


    private function createToken($credentials): JsonResponse
    {
        $company = Company::where(['email' => $credentials['email']])->firstOrFail();

        if( !Hash::check(request()->password, $company->password))
        {
            throw new ModelNotFoundException;
        }

        if ($company->device_token !== request('device_token'))
        {
            $company->device_token =  request('device_token');
            $company->save();
        }

        $token = $company->createToken('mobile_app_company_auth_token')->plainTextToken;

        return $this->respondWithToken($token,$company);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();
        return $this->respondWithSuccess('logout successfully');
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     * @param Company $company
     * @return JsonResponse
     */
    protected function respondWithToken(string $token,Company $company): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'company' => new CompanyResource($company)
        ]);
    }

    /**
     * @param Request $request
     * @return array
     */
    private function getCredentials (Request $request): array
    {
        $request->validate([
            'email'        => 'required|email|max:200',
            'password'     => 'required|string|max:24|min:8',
            'device_token' => 'required|string',
            'uid'          => 'required|string'
        ]);

        return $request->only(['email', 'password']);
    }

    public function update(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|unique:companies,email,'.auth('company')->id(),
            'country_code'  => 'required|regex:/^(\+)([1-9](\d{0,5}))/',
            'phone'         => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|unique:companies,phone,'.auth('company')->id(),
            'city_id'       => 'required|integer|exists:cities,id',
            'domain_id'     => 'required|integer|exists:domains,id',
            'latitude'      => 'sometimes|nullable|numeric',
            'longitude'     => 'sometimes|nullable|numeric',
            'address'       => 'sometimes|nullable|string|max:200',
            'facebook'  => 'sometimes|nullable|url',
            'twitter'   => 'sometimes|nullable|url',
            'instagram' => 'sometimes|nullable|url',
            'snapchat'  => 'sometimes|nullable|url',
            'website'  => 'sometimes|nullable|url',
            'trade_register'  => 'sometimes|nullable|file|image|max:3000',
        ]);

        $company = $this->company->update(auth('company')->id(),$data);

        return $this->respondWithSuccessWithoutArray(__('messages.update'),new CompanyResource($company));
    }

    public function updateSocialLink(Request $request): JsonResponse
    {
        $data = $request->validate([
            'facebook'  => 'sometimes|nullable|url',
            'twitter'   => 'sometimes|nullable|url',
            'instagram' => 'sometimes|nullable|url',
            'whatsapp'  =>'sometimes|nullable|url',
            'snapchat'  => 'sometimes|nullable|url',
            'website'  => 'sometimes|nullable|url',
        ]);

        $company = $this->company->update(auth('company')->id(),$data);

        return $this->respondWithSuccessWithoutArray(__('messages.update'),new CompanyResource($company));
    }

    public function uploadImage(Request $request): JsonResponse
    {
        $data = $request->validate([
            'image' => 'required|file|image|max:10000'
        ]);
        $company = $this->company->update(auth('company')->id(),$data);
        return $this->respondWithSuccessWithoutArray(__('messages.update'),new CompanyResource($company));
    }

    public function updateAddress(Request $request): JsonResponse
    {
        $data = $request->validate([
            'longitude' => 'required|numeric',
            'latitude' => 'required|numeric',
            'address' => 'required|string|max:200',
        ]);

        $company = $this->company->update(auth('company')->id(),$data);

        return $this->respondWithSuccessWithoutArray(__('messages.update'),new CompanyResource($company));
    }



}
