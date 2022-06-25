<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\{Hash, Storage};

class UserObserver
{
    public function creating(User $user)
    {
        $user->name = $user->username;
    }

    public function updating(User $user)
    {
        if ($user->isDirty('profile_image')) {
            if ($user->getOriginal('profile_image'))
                Storage::disk('public')->delete($user->getOriginal('profile_image'));
        }
    }

    public function saving(User $user)
    {
        $user->password = Hash::make($user->password);
    }
}
