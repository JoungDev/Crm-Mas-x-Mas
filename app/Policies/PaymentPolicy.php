<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Customer; // <- cambia el modelo según el archivo

class PaymentPolicy
{
    public function viewAny(User $user): bool { return true; }
    public function view(User $user, Customer $model): bool { return true; }

    public function create(User $user): bool { return $user->role === 'admin'; }
    public function update(User $user, Customer $model): bool { return $user->role === 'admin'; }
    public function delete(User $user, Customer $model): bool { return $user->role === 'admin'; }

    public function restore(User $user, Customer $model): bool { return false; }
    public function forceDelete(User $user, Customer $model): bool { return false; }
}
