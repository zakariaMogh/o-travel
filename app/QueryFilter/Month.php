<?php

namespace App\QueryFilter;

use App\Models\Offer;

class Month extends Filter
{
    protected function applyFilters($builder)
    {
        $q = request($this->filterName());

        if (empty($q)) {
            return $builder;
        }

        if ($builder->getModel() instanceof Offer) {
            $builder->where('date', 'like', '%' . $q . '%');
        }


        return $builder;
    }
}
