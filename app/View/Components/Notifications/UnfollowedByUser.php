<?php

namespace App\View\Components\Notifications;

use App\Models\User;
use Illuminate\View\Component;

class UnfollowedByUser extends Component
{
    public ?User $user;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        $this->user = User::find($data['user_id']);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.notifications.unfollowed-by-user');
    }
}
