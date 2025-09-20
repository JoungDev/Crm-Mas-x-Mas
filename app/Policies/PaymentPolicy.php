<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Payment; // <- cambia el modelo según el archivo

class PaymentPolicy
{
    public function viewAny(User $user): bool { return true; }
    public function view(User $user, Payment $model): bool { return true; }

    public function create(User $user): bool { return $user->role === 'admin'; }
    public function update(User $user, Payment $model): bool { return $user->role === 'admin'; }
    public function delete(User $user, Payment $model): bool { return $user->role === 'admin'; }

    public function restore(User $user, Payment $model): bool { return false; }
    public function forceDelete(User $user, Payment $model): bool { return false; }
}
