<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasFactory, SoftDeletes, TenantTrait;
    protected $guarded = [];

    public function manager()
    {
        return $this->belongsTo(Employee::class, 'manager_id');
    }
}
