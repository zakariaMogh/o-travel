<?php

namespace App\Observers;

use App\Models\Company;
use App\Services\FirebaseFCM;

class CompanyObserver
{

    /**
     * Handle the Company "updated" event.
     *
     * @param  \App\Models\Company  $company
     * @return void
     */
    public function updating(Company $company): void
    {
        if ($company->isDirty('checked') && $company->checked )
        {
            $fcm = new FirebaseFCM();
            if ($token = $company->fcm_token)
            {
                $fcm->send($token,trans_choice('labels.order',1),__('messages.offer_accepted'),
                    [
                        'route' => 'company',
                        'company_id' => $company->id,
                    ]
                );
            }
        }
    }


}
