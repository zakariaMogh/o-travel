<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;

class SettingsController extends ApiController
{

    public function privacy_policy(): JsonResponse
    {
        return $this->respond(['privacy_policy' => settings('privacy_policy')]);
    }

    public function about_us(): JsonResponse
    {
        return $this->respond(['about_us' => settings('about_us')]);
    }

    public function terms_of_use(): JsonResponse
    {
        return $this->respond(['terms_of_use' => settings('terms_of_use')]);
    }

}
