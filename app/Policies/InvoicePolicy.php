<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Invoice; 

class InvoicePolicy
{
    public function viewAny(User $user): bool { return true; }
    public function view(User $user, Invoice $model): bool { return true; }

    public function create(User $user): bool { return $user->role === 'admin'; }
    public function update(User $user, Invoice $model): bool { return $user->role === 'admin'; }
    public function delete(User $user, Invoice $model): bool { return $user->role === 'admin'; }

    public function restore(User $user, Invoice $model): bool { return false; }
    public function forceDelete(User $user, Invoice $model): bool { return false; }
}
