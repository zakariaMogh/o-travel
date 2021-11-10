<?php
namespace App\Contracts;


use App\Contracts\Base\CrudContract;
use App\Contracts\Base\ReportableContract;

interface CompanyContract extends CrudContract,ReportableContract
{
    public function checkToggle($id);
    public function activeToggle($id);
}
