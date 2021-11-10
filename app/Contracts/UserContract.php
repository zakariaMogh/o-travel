<?php
namespace App\Contracts;


use App\Contracts\Base\CrudContract;
use App\Contracts\Base\ReportableContract;

interface UserContract extends CrudContract,ReportableContract
{
    /**
     * @param $user
     * @param $offer
     * @return mixed
     */
    public function favoriteToggle($user,$offer);
}
