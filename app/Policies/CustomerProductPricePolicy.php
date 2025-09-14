<?php

namespace App\Policies;

use App\Models\User;
use App\Models\CustomerProductPrice; // <- cambia el modelo según el archivo

class CustomerProductPricePolicy
{
    public function viewAny(User $user): bool { return true; }
    public function view(User $user, CustomerProductPrice $model): bool { return true; }

    public function create(User $user): bool { return $user->role === 'admin'; }
    public function update(User $user, CustomerProductPrice $model): bool { return $user->role === 'admin'; }
    public function delete(User $user, CustomerProductPrice $model): bool { return $user->role === 'admin'; }

    public function restore(User $user, CustomerProductPrice $model): bool { return false; }
    public function forceDelete(User $user, CustomerProductPrice $model): bool { return false; }
}
