<?php

namespace App\Traits;

use App\Models\Role;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasRoles
{
    public function roles(): BelongsToMany
    {
        // Здесь необходимо динамически определять промежуточную таблицу или использовать полиморфные отношений
        return $this->belongsToMany(Role::class, 'role_user');
    }
    public function hasRole(string $role): bool
    {
        $this->loadMissing('roles');

        return $this->roles->contains('name', $role);
    }
}
