<?php

namespace App\View\Components\Notifications;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\View\Component;

class FollowedUserTweeted extends Component
{
    public mixed $tweet;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        $this->tweet = Tweet::query()->with('user')->find($data['tweet_id']);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.notifications.followed-user-tweeted');
    }
}
