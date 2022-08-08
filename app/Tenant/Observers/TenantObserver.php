<?php

namespace App\Tenant\Observers;

use App\Tenant\ManagerTenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class TenantObserver
{
    public function creating(Model $model)
    {
        if (auth()->check()) {
            if (auth()->user()->userlevel != 'super_admin') {
                $user = auth()->user();
                $model->setAttribute('company_id', $user->company_id);
                $model->setAttribute('creator_id', $user->id);
            }
        }
    }
}
