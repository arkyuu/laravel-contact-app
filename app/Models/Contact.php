<?php

namespace App\Models;

use App\Scopes\FilterScope;
use App\Scopes\SearchScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    public  $filterColumns = ['company_id'];
    public $searchColumns = ['first_name', 'last_name', 'email'];
    protected $fillable = ['first_name', 'last_name', 'email', 'phone', 'address', 'company_id'];
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function scopeLastestFirst($query)
    {
        return $query->orderBy('id', 'desc');
    }

    protected static function booted()
    {
        static::addGlobalScope(new FilterScope);
        static::addGlobalScope(new SearchScope);
    }
}
