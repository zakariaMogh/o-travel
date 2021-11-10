<?php

namespace App\QueryFilter;



class Category extends Filter
{

    protected function applyFilters($builder)
    {
        $q = request($this->filterName());

        if (empty($q)) {

            return $builder;
        }

        if ($builder->getModel() instanceof \App\Models\Offer) {
            $builder->where('category_id',  $q);
        }

        return $builder;
    }
}
