<?php

namespace App\Observers;

use App\Models\Tweet;
use App\Notifications\FollowedUserTweeted;

class TweetObserver
{
    public function creating(Tweet $tweet)
    {
        $tweet->content = trim($tweet->content);
    }

    public function created(Tweet $tweet)
    {
        $followers = auth()->user()->followers;

        foreach ($followers as $follower) {
            $follower->notify(new FollowedUserTweeted($tweet->getKey()));
        }
    }
}
