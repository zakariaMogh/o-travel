<?php

namespace App\QueryFilter;



class Featured extends Filter
{

    protected function applyFilters($builder)
    {
        $q = request($this->filterName());

        if (empty($q) || !in_array($q, [1,2])) {
            return $builder;
        }

        if ($builder->getModel() instanceof \App\Models\Offer) {
            $builder->where('featured',  $q);
        }

        return $builder;
    }
}
