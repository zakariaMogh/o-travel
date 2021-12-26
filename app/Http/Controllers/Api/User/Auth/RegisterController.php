<?php

namespace App\Http\Controllers\Api\User\Auth;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Kreait\Laravel\Firebase\Facades\Firebase;

class RegisterController extends ApiController
{

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name'      => 'required|string|max:100',
            'email'      => 'required|email|unique:users,email',
            'password'      => 'required|string|min:8|max:24|confirmed',
            'country_code' => 'sometimes|nullable|regex:/^(\+)([1-9](\d{0,5}))/',
            'device_token'  => 'required|string',
            'phone'         => 'sometimes|nullable|regex:/^([0-9\s\-\+\(\)]*)$/|unique:users,phone',
            'image_url' => 'sometimes|nullable|string'
        ]);


        try {
            //$phone = $data['country_code'].$data['phone'];
            //$this->checkFirebaseUser($phone);

            $user = User::create($data);
            $token = $user->createToken('mobile_app_user_auth_token')->plainTextToken;


            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => new UserResource($user)
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

    private function checkFireBaseUser($phone): void
    {
        $auth = Firebase::auth();
        $auth->getUserByPhoneNumber($phone);
    }

}
