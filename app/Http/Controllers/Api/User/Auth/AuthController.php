<?php

namespace App\Http\Controllers\Api\User\Auth;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\UploadAble;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Kreait\Firebase\Exception\Auth\UserNotFound;
use Kreait\Firebase\Exception\AuthException;
use Kreait\Firebase\Exception\FirebaseException;
use Kreait\Laravel\Firebase\Facades\Firebase;

class AuthController extends ApiController
{
    use UploadAble;

    private function createToken($credentials): JsonResponse
    {
        $user = User::where(['email' => $credentials])->firstOrFail();

        if( !Hash::check($credentials['password'], $user->password))
        {
            throw new ModelNotFoundException;
        }

        if ($user->device_token !== request('device_token'))
        {
            $user->device_token =  request('device_token');
            $user->save();
        }

        $token = $user->createToken('mobile_app_user_auth_token')->plainTextToken;

        return $this->respondWithToken($token,$user);
    }

    private function loginAttemptWithEmail(array $credentials,Request $request)
    {
        try {
            //$this->checkFireBaseUser($request->input('uid'),$request->input('email'));
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
    private function checkFireBaseUser($uid,$email): void
    {
        $auth = Firebase::auth();
        $user = $auth->getUser($uid);
        if($user->email !== $email){
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

        return $this->loginAttemptWithEmail($credentials,$request);
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
        $data = $request->validate(
            [
                'name' => 'required|string|max:200',
                'email' => 'required|string|email|unique:users,email,'.auth('user')->id(),
                'country_code'  => 'required|regex:/^(\+)([1-9](\d{0,5}))/',
                'phone'         => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|unique:users,phone,'.auth('user')->id(),
                'codeC'=>'nullable'
            ]);

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
            'image' => 'required|file|image|max:2000',
        ]);

        try
        {
            $data['image'] = $this->uploadOne($data['image'],'user/img');

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
            'email' => 'required|email',
            'password' => 'required|string|min:8|max:24',
            'device_token' => 'required|string',
            'uid' => 'required|string'
        ]);

        return $request->only(['email','password']);
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
