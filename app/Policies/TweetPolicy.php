<?php

namespace App\Policies;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TweetPolicy
{
    use HandlesAuthorization;

    public function show(?User $authUser, Tweet $tweet)
    {
        if(!$authUser) return !$tweet->user->is_private;

        return $authUser->is($tweet->user) || !$tweet->user->is_private || $authUser->hasBeenFollowing($tweet->user);
    }
}
