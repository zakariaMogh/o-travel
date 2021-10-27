<?php

namespace App\QueryFilter;



use App\Models\Admin;
use Spatie\Permission\Models\Role;

class Search extends Filter
{

    protected function applyFilters($builder)
    {
        $q = request($this->filterName());

        if (empty($q)) {
            return $builder;
        }

        if ($builder->getModel() instanceof Role) {
            $builder->where('name', 'like', '%' . $q . '%');
        }

        if ($builder->getModel() instanceof Admin) {
            $builder->where('name', 'like', '%' . $q . '%');
        }


        return $builder;
    }
}
