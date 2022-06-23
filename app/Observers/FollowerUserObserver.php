<?php

namespace App\Observers;

use App\Models\FollowerUser;
use App\Models\User;
use App\Notifications\FollowedByUser;
use App\Notifications\UnfollowedByUser;

class FollowerUserObserver
{
    public function creating(FollowerUser $followerUser)
    {
        User::query()->findOrFail($followerUser->user_id)
            ->notify(
                new FollowedByUser($followerUser->follower_id)
            );
    }

    public function deleting(FollowerUser $followerUser)
    {
        User::query()->findOrFail($followerUser->user_id)
            ->notify(
                new UnfollowedByUser($followerUser->follower_id)
            );
    }
}
