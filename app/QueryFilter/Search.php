<?php

namespace App\QueryFilter;



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


        return $builder;
    }
}
