<?php

namespace App\Enums;

use App\Notifications\FollowedByUser;
use App\Notifications\FollowedUserTweeted;
use App\Notifications\UnfollowedByUser;
use App\Notifications\UserRepliedToTweet;
use App\Notifications\UserLikedTweet;

enum NotificationTypes: string
{
    case FollowedUserTweeted = FollowedUserTweeted::class;
    case FollowedByUser = FollowedByUser::class;
    case UnfollowedByUser = UnfollowedByUser::class;
    case UserRepliedToTweet = UserRepliedToTweet::class;
    case UserLikedTweet = UserLikedTweet::class;
}
