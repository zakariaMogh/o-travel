<?php
namespace App\Contracts;


use App\Contracts\Base\CrudContract;

interface OfferContract extends CrudContract
{
    public function stateToggle($id, $state);
}
