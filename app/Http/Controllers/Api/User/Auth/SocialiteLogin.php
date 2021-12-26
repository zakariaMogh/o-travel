<?php

namespace App\Http\Controllers\Api\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Kreait\Firebase\Exception\AuthException;
use Kreait\Firebase\Exception\FirebaseException;
use Kreait\Laravel\Firebase\Facades\Firebase;

class SocialiteLogin extends Controller
{

    public function socialiteLogin(Request $request)
    {
        $rules = [
            'uid'   => 'required|string',
            'device_token' => 'required|string',
            'name' => 'required|string|max:90',
            'image' => 'sometimes|nulalble|string',
        ];

        if ($this->getUsername($request) === 'email')
        {
            $rules['username'] = 'required|string|email|max:200';
            $request->validate($rules);
            $this->checkFireBaseUser($request->get('uid'),$request->get('username'));
            return $this->createToken($request->all());
        }

        $rules['username'] = 'required|regex:/^([0-9\s\-\+\(\)]*)$/';
        $rules['country_code'] = 'required|regex:/^(\+)([1-9](\d{0,5}))/';
        $request->validate($rules);

        $this->checkFireBaseUser($request->get('uid'),$request->get('country_code').$request->get('username'));
        return $this->createToken($request->all());
    }

    /**
     * @throws FirebaseException
     * @throws AuthException
     * @throws Exception
     */
    private function checkFireBaseUser($uid,$username): void
    {
        $auth = Firebase::auth();
        $user = $auth->getUser($uid);

        if (filter_var($username, FILTER_VALIDATE_EMAIL) && $user->email === $username){
           return;
        }

        if ( $user->phoneNumber === $username){
            return;
        }

        throw new Exception(__('auth.failed'));
    }

    private function getUsername(Request $request){
        if (filter_var($request->input('username'), FILTER_VALIDATE_EMAIL)){
            return 'email';
        }
        return 'phone';
    }

    private function createToken($credentials): JsonResponse
    {
        
        if (filter_var($credentials['username'], FILTER_VALIDATE_EMAIL)){
            $user = User::firstOrCreate(['email' => $credentials['username']], $credentials);
        }else{
            $user = User::firstOrCreate(['phone' => $credentials['username']], $credentials);
        }

        if ($user->device_token !== request('device_token'))
        {
            $user->device_token =  request('device_token');
            $user->save();
        }

        $token = $user->createToken('mobile_app_user_auth_token')->plainTextToken;

        return $this->respondWithToken($token,$user);
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
}
