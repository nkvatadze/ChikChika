<?php

namespace App\View\Components\Notifications;

use App\Models\TweetLike;
use Illuminate\View\Component;

class UserLikedTweet extends Component
{
    public ?TweetLike $tweetLike;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        $this->tweetLike = TweetLike::query()->with('tweet', 'user')->find($data['tweet_like_id']);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.notifications.user-liked-tweet');
    }
}
