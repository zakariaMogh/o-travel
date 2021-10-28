<?php

namespace App\Http\Controllers\Api\V1\User\Auth;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\UploadAble;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Kreait\Firebase\Exception\Auth\UserNotFound;
use Kreait\Firebase\Exception\AuthException;
use Kreait\Firebase\Exception\FirebaseException;
use Kreait\Laravel\Firebase\Facades\Firebase;

class AuthController extends ApiController
{
    use UploadAble;

    private function createToken($credentials): JsonResponse
    {
        $user = User::where($credentials)->firstOrFail();

        if ($user->device_token !== request('device_token'))
        {
            $user->device_token =  request('device_token');
            $user->save();
        }

        $token = $user->createToken('mobile_app_user_auth_token')->plainTextToken;

        return $this->respondWithToken($token,$user);
    }

    private function loginAttemptWithPhone(array $credentials,Request $request)
    {
        try {
            $phone = $credentials['country_code'].$credentials['phone'];
            $this->checkFireBaseUser($request->input('uid'),$phone);
            return $this->createToken($credentials);
        }
        catch (UserNotFound  | ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => __("auth.failed"),

            ],404);
        }
        catch (AuthException | FirebaseException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ],401);
        }
        catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),

            ],500);
        }
    }

    /**
     * @throws FirebaseException
     * @throws AuthException
     * @throws Exception
     */
    private function checkFireBaseUser($uid,$phone): void
    {
        $auth = Firebase::auth();
        $user = $auth->getUser($uid);
        if($user->phoneNumber !== $phone){
            throw new Exception(__('auth.failed'));
        }
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
     * Log the user out (Invalidate the token).
     *
     * @param Request $request
     * @return JsonResponse
     */

    public function update(Request $request): JsonResponse
    {
        $data = $request->validate(['username' => 'required|string|min:2|max:200']);

        try
        {
            $this->guard()->user()->update($data);

            return $this->setStatusCode(201)->respondWithSuccess(
                __('messages.update'),
                [
                    'user' => new UserResource(user())
                ]
            );
        }catch (Exception $exception)
        {
            return  $this->setStatusCode(500)->respondWithError(__('messages.fail'));
        }

    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function updateImage(Request $request): JsonResponse
    {

        $data = $request->validate([
            'pic' => 'required|file|image|max:2000',
        ]);

        try
        {
            $data['pic'] = $this->uploadOne($data['pic'],'user/img');

            if ($pic = $this->guard()->user()->pic_url)
            {
                $this->deleteOne($pic);
            }
            user()->update($data);

            return $this->setStatusCode(201)->respondWithSuccess(
                __('messages.update'),
                [
                    'user' => new UserResource(user())
                ]
            );
        }catch (Exception $exception)
        {
            return  $this->setStatusCode(500)->respondWithError(__('messages.fail'));
        }
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     * @param User $user
     * @return JsonResponse
     */
    protected function respondWithToken(string $token,User $user): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => new UserResource($user)
        ]);
    }

    /**
     * @param Request $request
     * @return array
     */
    private function getCredentials (Request $request): array
    {
        $request->validate([
            'country_code' => 'required|regex:/^(\+)([1-9](\d{0,5}))/',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'device_token' => 'required|string',
            'uid' => 'required|string'
        ]);

        return $request->only(['phone','country_code']);
    }

    private function guard(){
        return auth()->guard('user');
    }

    public function me(): JsonResponse
    {
        return $this->respond([
            'user' => new UserResource(\user()),
        ]);
    }

}
