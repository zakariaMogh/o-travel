<?php

namespace App\Contracts\Base;

interface ReportableContract
{
    public function makeReport($id,array $data);
}
