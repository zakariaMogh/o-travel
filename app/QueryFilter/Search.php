<?php

namespace App\QueryFilter;



use App\Models\Admin;
use App\Models\Category;
use App\Models\City;
use App\Models\Company;
use App\Models\Country;
use App\Models\Domain;
use App\Models\User;
use Spatie\Permission\Models\Role;

class Search extends Filter
{

    protected function applyFilters($builder)
    {
        $q = request($this->filterName());

        if (empty($q)) {
            return $builder;
        }

        if ($builder->getModel() instanceof Role) {
            $builder->where('name', 'like', '%' . $q . '%');
        }

        if ($builder->getModel() instanceof Company) {
            $builder->where('name', 'like', '%' . $q . '%');
        }

        if ($builder->getModel() instanceof Admin) {
            $builder->where('name', 'like', '%' . $q . '%');
        }

        if ($builder->getModel() instanceof User) {
            $builder->where('name', 'like', '%' . $q . '%')
            ->orWhere('phone', 'like', '%' . $q . '%');
        }

        if ($builder->getModel() instanceof Category) {
            $builder->where('name', 'like', '%' . $q . '%');
        }

        if ($builder->getModel() instanceof City) {
            $builder->where('name', 'like', '%' . $q . '%');
        }

        if ($builder->getModel() instanceof Country) {
            $builder->where('name', 'like', '%' . $q . '%');
        }

        if ($builder->getModel() instanceof Domain) {
            $builder->where('name', 'like', '%' . $q . '%');
        }


        return $builder;
    }
}
