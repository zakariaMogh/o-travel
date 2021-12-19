<?php

namespace App\Contracts;

interface StoryContract extends Base\CrudContract
{
    public function toggle($id);
}
