<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    public function scopeUser($query)
    {
        return $query->where('auditable_type', User::class);
    }

    public function scopeRole($query)
    {
        return $query->where('auditable_type', Role::class);
    }

    public function scopePermission($query)
    {
        return $query->where('auditable_type', Permission::class);
    }
}
