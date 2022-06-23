<?php

namespace App\Observers;

use App\Models\Tweet;
use App\Notifications\FollowedUserTweeted;

class TweetObserver
{
    public function created(Tweet $tweet)
    {
        $followers = auth()->user()->followers;

        foreach ($followers as $follower) {
            $follower->notify(new FollowedUserTweeted($tweet->getKey()));
        }
    }
}
