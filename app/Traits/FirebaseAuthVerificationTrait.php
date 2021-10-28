<?php

namespace App\Traits;

use Exception;
use Kreait\Firebase\Exception\AuthException;
use Kreait\Firebase\Exception\FirebaseException;
use Kreait\Laravel\Firebase\Facades\Firebase;

trait FirebaseAuthVerificationTrait
{

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
}
