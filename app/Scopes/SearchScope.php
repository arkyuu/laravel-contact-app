<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;

class SearchScope implements Scope
{
    protected $searchColumns = [];
    public function apply(Builder $builder, Model $model)
    {
        if(request('search')){
            $columns = property_exists($model, 'searchColumns') ? $model->searchColumns : $this->searchColumns;
            foreach ($columns as $column) {
                $arr = explode('.', $column);
                if(count($arr) == 2){
                    $builder->orWhereHas($arr[0], function($query) use($arr){
                        $query->where($arr[1], 'like', '%'.request('search').'%');
                    });
                }else{
                    $builder->orWhere($column, 'like', '%' . request('search') . '%');
                }
            }
            //$builder->orWhereHas('company', function($query){
              //  $query->where('name', 'like', '%' . request('search') . '%');
            //});
        }
    }
}
