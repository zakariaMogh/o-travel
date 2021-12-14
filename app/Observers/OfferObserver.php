<?php

namespace App\Observers;

use App\Models\Offer;
use App\Notifications\OfferNotification;
use App\Services\FirebaseFCM;

class OfferObserver
{

    /**
     * Handle the Offer "created" event.
     *
     * @param  \App\Models\Offer  $offer
     * @return void
     */
    public function created(Offer $offer)
    {
        try {
            $fcm = new FirebaseFCM();
            $offer->company->notify(new OfferNotification(__('messages.new_offer'),$offer));
            if ($token = $offer->company->fcm_token)
            {
                $fcm->send($token,trans_choice('labels.order',1),__('messages.new_offer'),
                    [
                        'route' => 'offer',
                        'offer_id' => $offer->id,
                    ]
                );
            }
        }catch (\Exception $exception){}

    }

    /**
     * Handle the Offer "updated" event.
     *
     * @param  \App\Models\Offer  $offer
     * @return void
     */
    public function updating(Offer $offer)
    {

        try {
            $offer->company->notify(new OfferNotification(__('messages.offer_accepted'),$offer));

            if ($offer->state === 2  && $offer->isDirty('state'))
            {
                $fcm = new FirebaseFCM();
                if ($token = $offer->company->fcm_token)
                {
                    $fcm->send($token,trans_choice('labels.order',1),__('messages.offer_accepted'),
                        [
                            'route' => 'offer',
                            'offer_id' => $offer->id,
                        ]
                    );
                }
            }
        }catch (\Exception $exception){}
    }

}
