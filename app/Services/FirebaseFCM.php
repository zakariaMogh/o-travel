<?php

namespace App\Services;

class FirebaseFCM
{
    protected $messaging;

    public function __construct()
    {
        $this->messaging = app('firebase.messaging');
    }

    public function send($token, $title, $message,array $data = [])
    {
        try {
            $this->sendFirebaseNotification($this->getFireBaseNotification([
                'title' => $title,
                'body' => $message
            ]), $token,$data);
        } catch (\Exception $e) {
        }

    }

    private function sendFirebaseNotification(\Kreait\Firebase\Messaging\Notification $notification, $token,array $data = []): void
    {
        $message = \Kreait\Firebase\Messaging\CloudMessage::withTarget('token', $token)
            ->withNotification($notification)->withData($data);
        $this->messaging->send($message);
    }

    private function getFireBaseNotification(array $data): \Kreait\Firebase\Messaging\Notification
    {
        return \Kreait\Firebase\Messaging\Notification::fromArray($data);
    }
}
