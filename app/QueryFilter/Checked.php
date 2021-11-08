<?php

namespace App\QueryFilter;



class Checked extends Filter
{

    protected function applyFilters($builder)
    {
        $q = request($this->filterName());

        if (!in_array($q, [1, 0], false)) {

            return $builder;
        }

        if ($builder->getModel() instanceof \App\Models\Company) {
            $builder->where('checked',  (boolean)$q);
        }



        return $builder;
    }
}
