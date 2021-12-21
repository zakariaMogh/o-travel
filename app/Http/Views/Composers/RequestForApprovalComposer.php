<?php


namespace App\Http\Views\Composers;


use App\Models\Offer;
use App\Models\Company;
use Illuminate\View\View;

class RequestForApprovalComposer
{


    public function compose(View $view): View
    {
        $request_for_approval_count = Company::where('trade_register','<>',null)->where('checked',false)->count();
        $offers_for_approval_count = Offer::where('state', 1)->count();
        return $view->with([
            'request_for_approval_count' => $request_for_approval_count,
            'offers_for_approval_count' => $offers_for_approval_count,
        ]);
    }
}
