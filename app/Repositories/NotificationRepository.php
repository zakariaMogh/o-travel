<?php


namespace App\Repositories;


use App\Models\AdminNotification;
use App\Models\Company;
use App\Models\User;
use App\Traits\UploadAble;

class NotificationRepository extends BaseRepositories implements \App\Contracts\NotificationContract
{
    use UploadAble;
    protected $messaging;

    /**
     * @param AdminNotification $model
     * @param array $filters
     */
    public function __construct(AdminNotification $model, array $filters = [
        \App\QueryFilter\Search::class,
    ])
    {
        parent::__construct($model, $filters);
        $this->messaging = app('firebase.messaging');

    }

    /**
     * @inheritDoc
     */
    public function new(array $data)
    {
        if (array_key_exists('image',$data))
        {
            $data['image'] = $this->uploadOne($data['image'],'notifications/image');
        }
        return AdminNotification::create($data);
    }

    /**
     * @inheritDoc
     */
    public function update($id, array $data)
    {
        $n = $this->findOneById($id);
        if (array_key_exists('image',$data))
        {
            if ($n->image)
            {
                $this->deleteOne($n->image);
            }
            $data['image'] = $this->uploadOne($data['image'],'notifications/image');
        }
        $n->update($data);
        return $n;
    }

    /**
     * @inheritDoc
     */
    public function destroy($id)
    {
        return AdminNotification::destroy($id);
    }

    private function sendFirebaseNotification(\Kreait\Firebase\Messaging\Notification $notification, $token): void
    {

        $message = \Kreait\Firebase\Messaging\CloudMessage::withTarget('token', $token)
            ->withNotification($notification);
        $this->messaging->send($message);
    }


    private function getFireBaseNotification(array $data): \Kreait\Firebase\Messaging\Notification
    {
        return \Kreait\Firebase\Messaging\Notification::fromArray($data);
    }

    public function sendAdminNotification($id)
    {
        $n = $this->findOneById($id);
        switch ($n->receivers) {
            case 1:
                $tokens = Company::whereNotNull('device_token')->groupBy('device_token')->pluck('device_token')->toArray();
                break;
            case 2:
                $tokens = User::whereNotNull('device_token')->groupBy('device_token')->pluck('device_token')->toArray();
                break;
            default:
                $tokens = array_merge(User::whereNotNull('device_token')->groupBy('device_token')->pluck('device_token')->toArray(), Seller::whereNotNull('device_token')->groupBy('device_token')->pluck('device_token')->toArray());
                break;
        }
        $data = [
            'title' => $n->title,
            'body' => $n->message
        ];
//        $result = $this->messaging->validateRegistrationTokens($tokens);

        if (count($tokens) > 0) {
            $message = \Kreait\Firebase\Messaging\CloudMessage::new()
                ->withNotification($this->getFireBaseNotification(
                    $data
                ));
            $this->messaging->sendMulticast($message, $tokens);

        }


    }
}
