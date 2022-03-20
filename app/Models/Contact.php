<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'email', 'phone', 'address', 'company_id'];
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function scopeLastestFirst($query)
    {
        return $query->orderBy('id', 'desc');
    }

    public function scopeFilter($query)
    {
        if(request('company_id')){
            $query->where('company_id', request('company_id'));
        }

        if(request('search')){
            $query->where('first_name', 'like', '%' . request('search') . '%');
        }

        return $query;
    }
}
