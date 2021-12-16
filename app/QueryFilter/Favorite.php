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

        if (auth('user')->check())
        {
            if ($builder->getModel() instanceof \App\Models\Offer) {
                $builder->whereHas('users',  function ($query)  {
                    $query->where('users.id',auth('user')->id());
                });
            }
            return $builder;
        }

        if (auth('company')->check())
        {
            if ($builder->getModel() instanceof \App\Models\Offer) {
                $builder->whereHas('companies',  function ($query)  {
                    $query->where('companies.id',auth('company')->id());
                });
            }
            return $builder;
        }

        return $builder;
    }
}
