<?php

namespace App\Policies;

use App\Models\FoodStall;
use App\Models\User;

class FoodStallPolicy
{
    public function modify(User $user, FoodStall $foodStall): bool
    {
        return $user->role === User::ROLE_ADMIN
            || $foodStall->vendor?->user_id === $user->id;
    }
}

