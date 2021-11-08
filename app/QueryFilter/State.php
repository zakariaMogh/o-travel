<?php

namespace App\QueryFilter;



class State extends Filter
{

    protected function applyFilters($builder)
    {
        $q = request($this->filterName());

        if (empty($q) || !in_array($q, [1,2])) {
            return $builder;
        }

        if ($builder->getModel() instanceof \App\Models\User) {
            $builder->where('state',  $q);
        }

         if ($builder->getModel() instanceof \App\Models\Company) {
            $builder->where('state',  $q);
        }



        return $builder;
    }
}
