<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\View\View;
use Livewire\Component;

class ShowUser extends Component
{
    public User $user;
    public bool $isRestricted = false;

    protected $listeners = ['followToggle'];

    public function mount(User $user): void
    {
        $this->user = $user;
    }

    public function followToggle(User $user)
    {
        if ($this->user->is($user)) {
            $this->render();
        }
    }

    public function render(): View
    {
        if (request()->user()->cannot('view', $this->user)) {
            $this->user->load('tweets', 'followers', 'followings');
            $this->isRestricted = true;
        }

        $this->user->loadCount('followings', 'followers', 'followedByAuth');

        return view('livewire.show-user');
    }
}
