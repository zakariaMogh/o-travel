<?php

namespace App\Http\Controllers\Api\V1\Seller\Auth;

use App\Contracts\SellerContract;
use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Resources\SellerResource;
use App\Http\Resources\StatisticResource;
use App\Http\Resources\UserResource;
use App\Models\Seller;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;
use Kreait\Firebase\Exception\Auth\UserNotFound;
use Kreait\Firebase\Exception\AuthException;
use Kreait\Firebase\Exception\FirebaseException;
use Kreait\Laravel\Firebase\Facades\Firebase;

class SellerLoginController extends ApiController
{
    protected $seller;

    public function __construct(SellerContract $seller)
    {
        $this->seller = $seller;
    }

    /**
     * @return SellerResource
     */
    public function me(): SellerResource
    {

        $seller = $this->seller->setCounts(['followers'])->setRelations(['tags','workHour'])->findOneById(auth('seller')->id());
        $seller->update([
            'wallet' => 10000
        ]); // Todo
        return new SellerResource($seller);
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

            $phone = $credentials['country_code'].$credentials['phone'];
            $this->checkFireBaseUser($request->input('uid'),$phone);
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
        $seller = Seller::where($credentials)->firstOrFail();

        if ($seller->device_token !== request('device_token'))
        {
            $seller->device_token =  request('device_token');
            $seller->save();
        }

        $token = $seller->createToken('mobile_app_user_auth_token')->plainTextToken;

        return $this->respondWithToken($token,$seller);
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
     * @param Seller $seller
     * @return JsonResponse
     */
    protected function respondWithToken(string $token,Seller $seller): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'seller' => new SellerResource($seller)
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

    public function update(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|unique:sellers,email,'.auth('seller')->id(),
            'username' => 'required|string|max:100|unique:sellers,username,'.auth('seller')->id(),
        ]);

        $seller = $this->seller->update(auth('seller')->id(),$data);

        return $this->respondWithSuccessWithoutArray(__('messages.update'),new SellerResource($seller->load(['tags','workHour'])));
    }

    public function updateSocialLink(Request $request): JsonResponse
    {
        $data = $request->validate([
            'facebook' => 'sometimes|nullable|url',
            'twitter' => 'sometimes|nullable|url',
            'instagram' => 'sometimes|nullable|url',
        ]);

        $seller = $this->seller->update(auth('seller')->id(),$data);

        return $this->respondWithSuccessWithoutArray(__('messages.update'),new SellerResource($seller->load(['tags','workHour'])));
    }

    public function uploadImage(Request $request): JsonResponse
    {
        $data = $request->validate([
            'pic' => 'required|file|image|max:10000'
        ]);

        $seller = $this->seller->update(auth('seller')->id(),$data);

        return $this->respondWithSuccessWithoutArray(__('messages.update'),new SellerResource($seller->load(['tags','workHour'])));
    }

    public function updateAddress(Request $request): JsonResponse
    {
        $data = $request->validate([
            'lon' => 'required|numeric',
            'lat' => 'required|numeric',
            'address' => 'required|string|max:200',
            'city' => 'required|string|max:100',
            'residential' => 'required|string|max:100',
        ]);

        $seller = $this->seller->update(auth('seller')->id(),$data);

        return $this->respondWithSuccessWithoutArray(__('messages.update'),new SellerResource($seller->load(['tags','workHour'])));
    }

    public function updateWorkHour(Request $request): JsonResponse
    {
        $data = $request->validate([
            'saturday' => 'sometimes|nullable|string|max:100',
            'sunday'    => 'sometimes|nullable|string|max:100',
            'monday'   => 'sometimes|nullable|string|max:100',
            'tuesday'  => 'sometimes|nullable|string|max:100',
            'wednesday'=> 'sometimes|nullable|string|max:100',
            'thursday' => 'sometimes|nullable|string|max:100',
            'friday'   => 'sometimes|nullable|string|max:100',
        ]);

        $seller = $this->seller->setRelations()->findOneById(auth('seller')->id());
        $seller->workHour()->update($data);
        return $this->respondWithSuccessWithoutArray(__('messages.update'),new SellerResource($seller->load(['tags','workHour'])));
    }


    public function myFollowers(): AnonymousResourceCollection
    {
        $users = seller()->followers()->latest()->paginate(10);
        return  UserResource::collection($users);
    }

    public function myStatistics()
    {
        $seller = seller();
        $data = collect();
        $data->put('rate', $seller->rate);
        $data->put('followers_count', $seller->followers()->count());

        $orders_count = DB::table('orders')
            ->where('seller_id', $seller->id)
            ->where('state', '<>', 10)
            ->select(
                DB::raw("SUM(CASE
            WHEN state = '5' THEN 1 ELSE 0 END) AS completed"),
                DB::raw("SUM(CASE
            WHEN state = '6' THEN 1 ELSE 0 END) AS canceled"),
                DB::raw("SUM(CASE
            WHEN state = '5' THEN total ELSE 0 END) AS total_gains")
            )
            ->first();

        $data->put('total_gains', (double)$orders_count->total_gains);
        $data->put('canceled_orders', (int)$orders_count->canceled);
        $data->put('completed_orders', (int)$orders_count->completed);

        $db_days = DB::table('orders')
            ->where('seller_id', $seller->id)
            ->where('state', '<>', 10)
            ->whereBetween('created_at', [Carbon::now()->subWeek(), Carbon::now()])
            ->select(
                DB::raw("SUM(CASE
            WHEN state = '5' THEN 1 ELSE 0 END) AS completed"),
                DB::raw("SUM(CASE
            WHEN state = '6' THEN 1 ELSE 0 END) AS canceled"),
                DB::raw('DAY(created_at) day')
            )
            ->groupby( 'day')
            ->get();
        $days = [];

        $day = collect();
        $carbon_days = [];
        for ($i = 0; $i <= 6; $i++)
        {
            $today = Carbon::now()->subDays($i)->format('d');
            array_push($carbon_days, $today);
            if ($current = $db_days->where('day', $today)->first())
            {
                $day->put('canceled', (int)$current->canceled);
                $day->put('completed', (int)$current->completed);
            }else{
                $day->put('canceled', 0);
                $day->put('completed', 0);
            }
            array_push($days, $day->toArray());
        }
        $data->put('days', $days);
        return  $this->respond($data);
    }

}
