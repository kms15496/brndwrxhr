<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserObserver
{
    public function creating(User $user)
    {

        if ($user->password) {
            $user->password = Hash::make(request()->get('password'));
        }
    }

    public function updating(User $user)
    {
        if ($user->isDirty('password')) {
            $user->password = Hash::make(request()->get('password'));
        }


        $roleId = request()->get('role');
        if ($roleId) {
            $role = Role::find($roleId);
            if ($role) {
                $user->syncRoles([$role]);
            }
        }
    }
}
