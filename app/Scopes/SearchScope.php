<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;

class SearchScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if(request('search')){
            $builder->where('first_name', 'like', '%' . request('search') . '%');
            $builder->orWhere('last_name', 'like', '%' . request('search') . '%');
            $builder->orWhere('email', 'like', '%' . request('search') . '%');
        }
    }
}
