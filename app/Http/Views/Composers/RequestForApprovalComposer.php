<?php


namespace App\Http\Views\Composers;


use App\Models\Company;
use Illuminate\View\View;

class RequestForApprovalComposer
{


    public function compose(View $view): View
    {
        return $view->with(['request_for_approval_count'=>Company::where('trade_register','<>',null)->where('checked',false)->count()]);
    }
}
