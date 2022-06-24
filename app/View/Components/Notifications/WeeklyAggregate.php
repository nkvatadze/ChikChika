<?php

namespace App\View\Components\Notifications;

use Illuminate\View\Component;

class WeeklyAggregate extends Component
{
    public int $followerUsersCount;
    public int $followingUsersCount;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        $this->followerUsersCount = $data['follower_users_count'];
        $this->followingUsersCount = $data['following_users_count'];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.notifications.weekly-aggregate');
    }
}
