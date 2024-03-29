<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyCategory extends Model
{
    use
    HasFactory, SoftDeletes;
    protected $guarded = [];

    public function companies()
    {
        return $this->hasMany(Company::class, 'category_id');
    }
}
