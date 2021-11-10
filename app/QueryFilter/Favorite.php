<?php

namespace App\QueryFilter;



class Favorite extends Filter
{

    protected function applyFilters($builder)
    {
        $q = request($this->filterName());

        if (empty($q) || $q == false) {
            return $builder;
        }

        if (!auth('user')->check())
        {
            return $builder;
        }

        if ($builder->getModel() instanceof \App\Models\Offer) {
            $builder->whereHas('users',  function ($query)  {
                $query->where('users.id',auth('user')->id());
            });
        }

        return $builder;
    }
}
