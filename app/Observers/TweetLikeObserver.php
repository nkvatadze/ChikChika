<?php

namespace App\Observers;

use App\Models\TweetLike;
use App\Models\User;
use App\Notifications\UserLikedTweet;

class TweetLikeObserver
{
    public function created(TweetLike $tweetLike)
    {
        $user = $tweetLike->tweet->user;

        if ($user->isNot(auth()->user())) {
            $user->notify(
                new UserLikedTweet($tweetLike->id)
            );
        }
    }
}
