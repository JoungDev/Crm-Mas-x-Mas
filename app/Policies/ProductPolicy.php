<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Product; // <- cambia el modelo según el archivo

class ProductPolicy
{
    public function viewAny(User $user): bool { return true; }
    public function view(User $user, Product $model): bool { return true; }

    public function create(User $user): bool { return $user->role === 'admin'; }
    public function update(User $user, Product $model): bool { return $user->role === 'admin'; }
    public function delete(User $user, Product $model): bool { return $user->role === 'admin'; }

    public function restore(User $user, Product $model): bool { return false; }
    public function forceDelete(User $user, Product $model): bool { return false; }
}
