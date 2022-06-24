<?php

namespace App\Observers;

use App\Models\TweetReply;
use App\Notifications\UserRepliedToTweet;

class TweetReplyObserver
{
    public function creating(TweetReply $tweetReply)
    {
        $tweetReply->content = trim($tweetReply->content);
    }

    public function created(TweetReply $tweetReply)
    {
        $user = $tweetReply->tweet->user;

        if ($user->isNot(auth()->user())) {
            $user->notify(
                new UserRepliedToTweet($tweetReply->id)
            );
        }
    }
}
