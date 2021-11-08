<?php
namespace App\Contracts;


use App\Contracts\Base\CrudContract;

interface CompanyContract extends CrudContract
{
    public function checkToggle($id);
    public function activeToggle($id);
}
