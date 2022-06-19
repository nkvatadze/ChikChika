<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Builder;

class UserPolicy
{
    use HandlesAuthorization;

    public function view(User $user)
    {
        return !$user->is_private || auth()->user()->hasBeenFollowing($user);
    }
}
