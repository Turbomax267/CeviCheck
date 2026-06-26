<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vendor;

class VendorPolicy
{
    public function modify(User $user, Vendor $vendor): bool
    {
        return $user->role === User::ROLE_ADMIN || $vendor->user_id === $user->id;
    }
}

