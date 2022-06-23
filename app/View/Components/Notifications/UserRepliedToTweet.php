<?php

namespace App\View\Components\Notifications;

use App\Models\TweetReply;
use Illuminate\View\Component;

class UserRepliedToTweet extends Component
{
    public ?TweetReply $tweetReply;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        $this->tweetReply = TweetReply::query()->with('tweet', 'user')->find($data['tweet_reply_id']);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.notifications.user-replied-to-tweet');
    }
}
