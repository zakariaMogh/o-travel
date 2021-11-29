<?php

namespace App\QueryFilter;



class Company extends Filter
{

    protected function applyFilters($builder)
    {
        $q = request($this->filterName());

        if (empty($q)) {

            return $builder;
        }

        if ($builder->getModel() instanceof \App\Models\Offer) {
            $builder->where('company_id',  $q);
        }

        return $builder;
    }
}
