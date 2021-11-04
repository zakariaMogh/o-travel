<?php

namespace App\QueryFilter;



class Checked extends Filter
{

    protected function applyFilters($builder)
    {
        $q = request($this->filterName());

        if (empty($q)) {
            return $builder;
        }

        if ($builder->getModel() instanceof \App\Models\Company) {
            $builder->where('checked',  $q);
        }



        return $builder;
    }
}
