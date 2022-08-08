<?php

namespace App\Tenant\Scopes;

use App\Tenant\ManagerTenant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Schema;

class TenantScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if(auth()->check()) {
            $user = auth()->user();
            if(auth()->user()->userlevel != 'super_admin') {
                $builder->where('company_id', $user->company_id);
            }
        }
    }
}
