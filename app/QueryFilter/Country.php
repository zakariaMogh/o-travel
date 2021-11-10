<?php

namespace App\QueryFilter;



class Country extends Filter
{

    protected function applyFilters($builder)
    {
        $q = request($this->filterName());

        if (empty($q)) {

            return $builder;
        }

        if ($builder->getModel() instanceof \App\Models\Offer) {
            $builder->whereHas('countries',  function ($query) use ($q){
                $query->where('id',$q);
            });
        }

        return $builder;
    }
}
