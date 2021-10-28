<?php

namespace App\QueryFilter;



class State extends Filter
{

    protected function applyFilters($builder)
    {
        $q = request($this->filterName());

        if (empty($q)) {
            return $builder;
        }

        if ($builder->getModel() instanceof \App\Models\User) {
            $builder->where('state',  $q);
        }



        return $builder;
    }
}
