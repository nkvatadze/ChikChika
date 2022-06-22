<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\View\View;
use Livewire\Component;

class ShowUser extends Component
{
    use AuthorizesRequests;

    public User $user;
    public bool $isRestricted = false;

    protected $listeners = ['followToggle'];

    public function mount(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @throws AuthorizationException
     */
    public function followToggle(User $user)
    {
        if ($this->user->is($user)) {
            $this->render();
        }
    }

    /**
     * @throws AuthorizationException
     */
    public function render(): View
    {
        if (!request()->user()) { // If user is guest
            $this->isRestricted = (bool)$this->user->is_private;
        } else if (request()->user()->cannot('view', $this->user)) { // Check if user can view tweets
            $this->user->load('tweets', 'followers', 'followings');
            $this->isRestricted = true;
        } else { // Refresh initial value of isRestricted
            $this->isRestricted = false;
        }

        $this->user->loadCount('followings', 'followers', 'followedByAuth');

        return view('livewire.show-user');
    }
}
